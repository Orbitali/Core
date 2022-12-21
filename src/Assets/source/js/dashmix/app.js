import "select2";
import Dropzone from "dropzone";
import IMask from "imask";
import Quill from "quill";
import BlotFormatter from '@chuyik/quill-blot-formatter';
Quill.register('modules/blotFormatter', BlotFormatter);
import "bootstrap";
import "popper.js";
import "jquery.appear";
import "jquery-scroll-lock";
//import SimpleBar from "simplebar";
import Dragula from "dragula";

import Tools from "./modules/tools";
import Helpers from "./modules/helpers";
import Template from "./modules/template";


String.prototype.to128Charset = function () {
    return this.replace('Ğ','g')
        .replace('Ü','u')
        .replace('Ş','s')
        .replace('I','i')
        .replace('İ','i')
        .replace('Ö','o')
        .replace('Ç','c')
        .replace('ğ','g')
 		.replace('ü','u')
        .replace('ş','s')
        .replace('ı','i')
        .replace('ö','o')
        .replace('ç','c');
};

export default class App extends Template {
    constructor() {
        super();
    }

    _uiInit() {
        this.fileSvgs = {
            file: require("../../images/filetypes/file.svg"),
            pdf: require("../../images/filetypes/pdf.svg"),
        };
        jQuery.expr[":"].hasData = function (obj, index, meta, stack) {
            return undefined !== $(obj).data(meta[3]);
        };

        this.structPage();
        this.categoryPage();
        this.menuPage();

        //Call original function
        super._uiInit();

        this.helpers([
            "datepicker",
            "colorpicker",
            "maxlength",
            "select2",
            "rangeslider",
        ]);
        this.mask();
        this.dropzone();
        this.select2PreventSort();
        this.stickyTop();
        this.dirtyForm();
        this.previewModal();
        this.initRepeaterPanel();
        this.initPopoverRemove();
        this.initFormAction();
        this.editor();
        this.textarea();
        this.toast();
    }

    dirtyForm() {
        jQuery("form:not(.js-form-dirty-enable)").each((i, p) => {
            var el = jQuery(p).addClass("js-form-dirty-enable");
            var submitBtn = jQuery("[type=submit]", el);
            jQuery(el).on("dirty", function () {
                submitBtn.removeClass("btn-dual").addClass("btn-primary");
            });
            jQuery(el).one(
                "input",
                "input,select,textarea",
                jQuery.fn.trigger.bind(el, "dirty")
            );
        });
    }

    previewModal() {
        var modal = `
        <div class="modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-primary-dark">
                            <h3 class="block-title">Preview</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                    <i class="fa fa-fw fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content"></div>
                    </div>
                </div>
            </div>
        </div>
        `;
        var self = this;
        jQuery("[data-preview]:not(.js-preview-enable)").each((i, el) => {
            var $el = jQuery(el).addClass("js-preview-enable");
            $el.on("click", function (e) {
                e.preventDefault();
                var $block = $el
                    .closest(".block")
                    .addClass("block-mode-loading");
                var $form = $el.closest("form");
                var url = $el.data("preview") || $el.attr("href");
                var $modal = jQuery(modal);
                var structure = self.structToJSON(design);
                var csrf = jQuery("[name=_token]", $form).val();
                jQuery("[data-dismiss=modal]", $modal).on("click", function () {
                    $modal.modal("hide").remove();
                });

                $.ajax({
                    url,
                    method: "POST",
                    contentType: "application/json",
                    data: JSON.stringify({ structure }),
                    headers: { "X-CSRF-TOKEN": csrf },
                    success: function (response) {
                        $(".block-content", $modal).html(response);
                        $modal.appendTo(document.body).modal("show");
                        jQuery(".block-header", $modal).addClass("sticky-top");
                        self.init();
                        $block.removeClass("block-mode-loading");
                    },
                });
            });
        });
    }

    stickyTop() {
        jQuery(".sticky-top:not(.js-sticky-top-enable)").each((i, p) => {
            var el = jQuery(p).addClass("js-sticky-top-enable");
            var level = el.parents(".block").length - 1;
            el.css("z-index", 900 - level);
            el.css("top", 55 * level);
            if (
                !el.hasClass("block-header") &&
                el.parents(".modal-dialog").length > 0
            ) {
                el.css("padding-right", 0);
                el.css("margin-right", 0);
            }
        });
    }

    select2PreventSort() {
        jQuery(".js-select2-enabled:not(.js-select2-configured)")
            .addClass("js-select2-configured")
            .each((index, element) => {
                var $el = jQuery(element);

                if ($el.data("prevent-sort") == 1) {
                    $el.on("select2:select", function (evt) {
                        var element = evt.params.data.element;
                        var $element = $(element);

                        $element.detach();
                        $(this).append($element);
                        $(this).trigger("change");
                    });
                }
            });
    }

    mask() {
        var w = "w".repeat(400);
        jQuery(".js-imask:not(.js-imask-enabled)").each((index, element) => {
            let $el = jQuery(element);
            $el.addClass("js-imask-enabled");

            var ops = {
                lazy: $el.data("lazy") || false,
                overwrite: $el.data("overwrite") || false,
                placeholderChar: $el.data("placeholderChar") || "_",
            };
            var isSlug =!!$el.data("slug");
            if (isSlug) {
                ops.mask = "{" + $el.data("slug").replace(/./g,c=>'\\'+c) + "}`" + w;
                ops.definitions = { w: /[\w-]/ };
                ops.lazy = true;
                ops.prepare = str => str.toLocaleLowerCase().to128Charset();
            } else {
                ops.mask =
                    $el.data("mask") ||
                    ($el.data("regex")
                        ? (v) => new RegExp($el.data("regex")).test(v)
                        : false);
            }

            var maskInput = IMask(element, ops);
            if(isSlug){
                var $formGroup = jQuery(element).closest('.form-group')
                var $nameElement = $formGroup.parent().find("[name$='[name]']");
                //
                if($nameElement.length > 0){
                    var $invalidMessage = $el.siblings('.invalid-feedback').detach();
                    $el.detach();
                    var checkboxId = element.id+"_slug";
                    var $wrapper = jQuery('<div class="input-group"><div class="input-group-prepend"><div class="input-group-text input-group-text-alt"><input type="checkbox" id="'+checkboxId+'" class="slug-checkbox"><label class="mb-0 fa fa-fw" for="'+checkboxId+'"></label></div></div></div>');
                    $wrapper.append($el);
                    $wrapper.append($invalidMessage);
                    $formGroup.append($wrapper);
                    
                    var $slugCheckbox = $wrapper.find('.slug-checkbox');
                    var currentVal = $nameElement.val().replace(/\s/g,'-');
                    var slugIsActive = !maskInput.unmaskedValue || maskInput.masked.resolve("." + currentVal) == maskInput.unmaskedValue;
                    maskInput.masked.resolve(maskInput.unmaskedValue);
                    $slugCheckbox.prop('checked',slugIsActive);
                    $slugCheckbox.on('change',function(){
                        slugIsActive = $slugCheckbox.prop('checked');
                        $el.prop('readonly',slugIsActive);
                    });
                    $slugCheckbox.trigger('change');
                    $nameElement.on('input',function(){
                        if(!slugIsActive)
                            return;
                        var newSlug = this.value.replace(/\s/g,'-');
                        maskInput.unmaskedValue = "." + newSlug;
                    });
                }
            }
        });
    }

    fileTypeSvgConvert(mime) {
        mime = mime.replace(/application.(.*?)/, "$1").toLocaleLowerCase();
        return (this.fileSvgs[mime] ?? this.fileSvgs.file).default;
    }

    dropzone() {
        var self = this;
        jQuery(".js-dropzone:not(.js-dropzone-enabled)").each(
            (index, element) => {
                var el = jQuery(element).addClass(
                    "js-dropzone-enabled dropzone"
                );
                var isMultiple = !!el.data("multiple");
                var form = el.closest("form");
                var csrf = jQuery("[name=_token]", form).val();
                var zone = new Dropzone(element, {
                    url: el.data("url"),
                    headers: { "X-CSRF-TOKEN": csrf },
                    paramName: el.data("paramname") || "file",
                    maxFilesize: el.data("maxfilesize") || 2,
                    maxFiles: el.data("maxfiles") || null,
                    addRemoveLinks: el.data("addRemoveLinks") || true,
                    thumbnailMethod: el.data("thumbnailMethod") || "contain",
                    init: function () {
                        el.data("files").forEach((file) => {
                            this.emit("addedfile", file);
                            if (file.type.match(/image.*/)) {
                                this.emit("thumbnail", file, file.preview);
                            } else {
                                this.emit(
                                    "thumbnail",
                                    file,
                                    self.fileTypeSvgConvert(file.type)
                                );
                            }
                            this.files.push(file);
                            jQuery(".dz-size", file.previewElement).remove();
                            this.emit("complete", file);
                        });
                    },
                    success: function (file, response) {
                        file.path = response;
                    },
                });
                zone.on("addedfile", function (file) {
                    if (!file.type.match(/image.*/)) {
                        this.emit(
                            "thumbnail",
                            file,
                            self.fileTypeSvgConvert(file.type)
                        );
                    }
                    jQuery.fn.trigger.call(form, "dirty");
                });

                form.on("submit", function (e) {
                    zone.getAcceptedFiles().forEach((file) => {
                        jQuery(this).append(
                            "<input type=hidden name='" +
                                el.data("name") + (isMultiple ? "[]":"") +
                                "' value='" +
                                file.path +
                                "' />"
                        );
                    });
                    if (zone.files.length == 0) {
                        jQuery(this).append(
                            "<input type=hidden name='" +
                                el.data("name") + (isMultiple ? "[]":"") +
                                "' />"
                        );
                    }
                });

                var preventDefault = (e) => e.preventDefault();
                Dragula([element], {
                    direction:
                        Tools.getWidth() < 425 ? "vertical" : "horizontal",
                    mirrorContainer: element,
                    ignoreInputTextSelection: false,
                    slideFactorX: 20,
                    slideFactorY: 20,
                    moves: function (el, source, handle, sibling) {
                        return el.classList.contains("dz-preview");
                    },
                })
                    .on("drag", function (e) {
                        $(e).on("touchmove", preventDefault);
                        el.removeClass("dz-clickable");
                    })
                    .on("dragend", function (e) {
                        //$(e).off("touchmove", preventDefault);
                        el.addClass("dz-clickable");
                        var queue = zone.files;
                        var newQueue = [];
                        jQuery(
                            ".dz-preview .dz-filename [data-dz-name]",
                            el
                        ).each(function (count, e) {
                            var name = e.innerText;
                            queue.forEach(function (file) {
                                if (file.name === name) {
                                    newQueue.push(file);
                                }
                            });
                        });
                        zone.files = newQueue;
                        jQuery.fn.trigger.call(form, "dirty");
                    });
            }
        );
    }

    structToJSON(node, $children = []) {
        var self = this;
        jQuery(">:hasData(data)", node).each(function (ind, elm) {
            var $c = self.structToJSON(jQuery(">.block-content", elm));
            var c = [];
            if ($c.length > 0) {
                c[":children"] = $c;
            }
            $children.push({
                ":tag": elm.nodeName.toLocaleLowerCase(),
                ...jQuery(elm).data("data"),
                ...c,
            });
        });
        return $children;
    }

    structPage() {
        var self = this;
        jQuery("#visual_desinger:not(.js-enabled)").each((index, element) => {
            var $el = jQuery(element).addClass("js-enabled");
            jQuery.each(element.children, initData);
            jQuery(element).on("click", "[data-configure]", configureModal);

            $(element)
                .closest("form")
                .on("submit", function (e) {
                    var $block = $el
                        .closest(".block")
                        .addClass("block-mode-loading");
                    $(structure_form_data).val(
                        JSON.stringify(self.structToJSON(design))
                    );
                });

            var drag = Dragula([...element.children], {
                isContainer: function (el) {
                    return (
                        el.classList.contains("block-content") &&
                        !jQuery(el).closest(".gu-transit").length &&
                        !!jQuery(el).closest("#design").length
                    );
                },
                accepts: function (el, target) {
                    return (
                        !jQuery(target).closest("#elements").length &&
                        !jQuery(target).closest(".salt").length
                    );
                },
                copy: function (el, source) {
                    return source.id == "elements";
                },
                invalid: function (el, handle) {
                    return jQuery(el).closest(".salt").length;
                },
                removeOnSpill: true,
                slideFactorX: 20,
                slideFactorY: 20,
            });

            drag.on("drop", jQuery.fn.trigger.bind(jQuery(element), "dirty"));
            drag.on("cloned", function (el, source, type) {
                if (type == "copy") {
                    let clone = jQuery(">.block-content", source).clone(
                        true,
                        true
                    );
                    jQuery(">.block-content", el).replaceWith(clone);
                    jQuery(el).data("data", jQuery(source).data("data"));
                }
            });
        });

        function initData(i, el) {
            let $el = jQuery(el);
            let childData = $el.data("data");
            if (!childData) return;
            childData.forEach((data) => {
                renderChildren($el, data);
            });
        }

        function renderChildren($el, data) {
            let template = block_template.content.cloneNode(true);
            let children = data[":children"] ?? false;
            delete data[":children"];
            $(".block", template).data("data", data);
            $(".block-title", template).text(data["title"]);
            let $content = $(".block-content", template);
            if (data[":salt"]) $content.addClass("salt");
            if (!children) {
                $content.remove();
                $("[data-action=content_toggle]", template).remove();
            } else {
                children.forEach((child) => {
                    renderChildren($content, child);
                });
            }
            $el.append(template);
        }

        // prettier-ignore
        function configureModal({ target }) {
            var $target = jQuery(target);
            var $block = $target.closest(".block");
            var data = $block.data("data");
            var $modal = jQuery(".modal", block_configure_modal.content).clone(true,true);
            jQuery("[data-dismiss=modal]", $modal).on("click", function (e) {
                e.preventDefault();
                e.stopPropagation();
                if (this.type == "submit") {
                    //Save Data
                    data = {
                        ...data,
                        title: jQuery("#title", $modal).val(),
                        name: jQuery("#name", $modal).val(),
                        type: jQuery("#type", $modal).val(),
                        ":rules": jQuery("#rules", $modal).val(),
                        ":multiple": jQuery("#multiple", $modal).prop("checked"),
                        ":mask": jQuery("#mask", $modal).val(),
                        ":overwrite": jQuery("#overwrite", $modal).prop("checked"),
                        ":auto-height": jQuery("#auto-height", $modal).prop("checked"),
                        ":prevent-sort": jQuery("#prevent-sort", $modal).prop("checked"),
                        ":placeholderChar": jQuery("#placeholderChar",$modal).val(),
                        ":content": jQuery("#content", $modal).val(),
                        ":data-source": jQuery("#data-source", $modal).val(),
                        ":show-on-list": jQuery("#show-on-list", $modal).prop("checked"),
                        ":show-on-list-empty-header": jQuery("#show-on-list-empty-header", $modal).prop("checked"),
                        ":show-on-list-order": jQuery("#show-on-list-order", $modal).val(),
                        ":show-on-list-prefix": jQuery("#show-on-list-prefix", $modal).val(),
                    };

                    //Update structure screen
                    $(">.block-header .block-title", $block).text(data["title"]);

                    //Clean undefined data
                    data = Object.entries(data).reduce((a, [k, v]) => (v === undefined ? a : ((a[k] = v), a)),{});

                    $block.data("data", data);
                }
                $modal.modal("hide").remove();
            });

            //Clean components on screen
            $("[id^=p_]", $modal).each((i, el) => {
                var name = el.id.replace("p_", "");
                if (!data.hasOwnProperty(name) && !data.hasOwnProperty(":" + name)) {
                    jQuery(el).remove();
                }
            });

            $modal.appendTo(document.body).modal("show");
            jQuery(".block-header", $modal).addClass("sticky-top");

            //Title
            jQuery("#title", $modal).val(data["title"]);

            //Name
            jQuery("#name", $modal).val(data["name"]);

            //Type
            jQuery("#type", $modal).val(data["type"]).trigger("change");

            //Rules
            self.helpers(["select2"]);
            self.select2PreventSort();
            var $select2 = jQuery("#rules", $modal);
            var rules = data[":rules"] ?? [];
            jQuery.fn.each.call(rules, (_, rule) => {
                var $rule = $select2.find("option[value='" + rule + "']");
                if ($rule.length) {
                    $rule.detach();
                } else {
                    $rule = new Option(rule, rule, true, true);
                }
                $select2.append($rule);
            });
            $select2.val(rules).trigger("change");

            //Multiple
            data[":multiple"] && jQuery("#multiple", $modal).attr("checked", "checked");

            //Mask
            jQuery("#mask", $modal).val(data[":mask"]);

            //Overwrite
            data[":overwrite"] && jQuery("#overwrite", $modal).attr("checked", "checked");
            
            //Prevent Sort
            data[":prevent-sort"] && jQuery("#prevent-sort", $modal).attr("checked", "checked");

            //Auto Height
            data[":auto-height"] && jQuery("#auto-height", $modal).attr("checked", "checked");

            //PlaceholderChar
            jQuery("#placeholderChar", $modal).val(data[":placeholderChar"]);

            //Content
            jQuery("#content", $modal).val(data[":content"]);

            //Data Source
            var $datasource = jQuery("#data-source", $modal);
            var sources = !data[":data-source"] ? [] : [data[":data-source"]];
            jQuery.fn.each.call(sources, (_, rule) => {
                var $rule = $datasource.find("option[value='" + rule.replaceAll("\\","\\\\") + "']");
                if ($rule.length) {
                    $rule.detach();
                } else {
                    $rule = new Option(rule, rule, true, true);
                }
                $datasource.append($rule);
            });
            $datasource.val(sources).trigger("change");

            //Show on List
            data[":show-on-list"] && jQuery("#show-on-list", $modal).attr("checked", "checked");
            data[":show-on-list-empty-header"] && jQuery("#show-on-list-empty-header", $modal).attr("checked", "checked");
            jQuery("#show-on-list-order", $modal).val(data[":show-on-list-order"]);
            jQuery("#show-on-list-prefix", $modal).val(data[":show-on-list-prefix"]);
        }
    }

    categoryPage(){
        jQuery("#category_desinger:not(.js-enabled)").each((index, element) => {
            var $el = jQuery(element).addClass("js-enabled");
            jQuery.each(element.children, initData);
            jQuery("[data-update]", element).each(function(i,target) {
                var $target = jQuery(target);
                var $block = $target.closest(".block");
                var data = $block.data("data");
                $target.attr("href",data["editAction"]);
            });
            jQuery("[data-destroy]", element).each(function(i,target) {
                var $target = jQuery(target);
                var $block = $target.closest(".block");
                var data = $block.data("data");
                jQuery("form",$target).attr("action",data["removeAction"]);
            });

            $(element)
                .closest("form")
                .on("submit", function (e) {
                    $el.closest(".block").addClass("block-mode-loading");
                    $(category_form_data).val(JSON.stringify(categoryToJSON(design)));
                });
            
            var drag = Dragula([...element.children], {
                isContainer: function (el) {
                    return (
                        el.classList.contains("block-content") &&
                        !jQuery(el).closest(".gu-transit").length &&
                        !!jQuery(el).closest("#design").length
                    );
                },
                accepts: function (el, target) {
                    return (
                        !jQuery(target).closest("#elements").length &&
                        !jQuery(target).closest(".salt").length
                    );
                },
                copy: function (el, source) {
                    return source.id == "elements";
                },
                invalid: function (el, handle) {
                    return jQuery(el).closest(".salt").length;
                },
                //removeOnSpill: true,
                slideFactorX: 20,
                slideFactorY: 20,
            });

            drag.on("drop", jQuery.fn.trigger.bind(jQuery(element), "dirty"));
        });

        function initData(i, el) {
            let $el = jQuery(el);
            let childData = $el.data("data");
            if (!childData) return;
            childData.forEach((data) => {
                renderChildren($el, data);
            });
        }

        function renderChildren($el, data) {
            let template = block_template.content.cloneNode(true);
            let children = data["children"] ?? false;
            delete data["children"];
            $(".block", template).data("data", data).attr("id","category" + data["id"]);
            $(".block-title", template).text(data["detail"]["name"]);
            let $content = $(".block-content", template);
            if (data[":salt"]) $content.addClass("salt");
            if (!children) {
                $content.remove();
                $("[data-action=content_toggle]", template).remove();
            } else {
                children.forEach((child) => {
                    renderChildren($content, child);
                });
            }
            $el.append(template);
        }

        function categoryToJSON(node, $children = []) {
            jQuery(">:hasData(data)", node).each(function (ind, elm) {
                var $c = categoryToJSON(jQuery(">.block-content", elm));
                var c = [];
                if ($c.length > 0) {
                    c["children"] = $c;
                }
                var data = jQuery(elm).data("data");
                delete data["lft"];
                delete data["rgt"];
                delete data["status"];
                delete data["extras"];
                delete data["detail"];
                delete data["editAction"];
                delete data["removeAction"];
                $children.push({
                    ...data,
                    ...c,
                });
            });
            return $children;
        }
    }

    menuPage(){
        jQuery("#menu_desinger:not(.js-enabled)").each((index, element) => {
            var $el = jQuery(element).addClass("js-enabled");

            jQuery.each(element.children, initData);
            jQuery("[data-update]", element).each(function(i,target) {
                var $target = jQuery(target);
                var $block = $target.closest(".block");
                var data = $block.data("data");
                $target.attr("href",data["editAction"]);
                $target.on("click",function(event){
                    event.preventDefault();

                    var $modal = jQuery(".modal", block_edit_modal.content).clone(true,true);
                    jQuery("[data-dismiss=modal]", $modal).on("click", function () {
                        $modal.modal("hide").remove();
                    });

                    $(".block-content>iframe", $modal)
                        .attr("src",data["editAction"] + "?compact=1")
                        .on("load",function(){
                            let docHeight = document.body.clientHeight / 1.8;
                            let minHeight = Math.min(docHeight,this.contentDocument.body.clientHeight);
                            $(this).height(minHeight + "px");
                        });
                    $modal.appendTo(document.body).modal("show");
                    jQuery(".block-header", $modal).addClass("sticky-top");

                    window["modalSubmitted"+data["id"]] = function(id,name){
                        delete window["modalSubmitted"+data["id"]];
                        $(">.block-header .block-title", "#menu"+ id).text(name);
                        $modal.modal("hide").remove();
                    };
                });
            });
            jQuery("[data-destroy]", element).each(function(i,target) {
                var $target = jQuery(target);
                var $block = $target.closest(".block");
                var data = $block.data("data");
                jQuery("form",$target).attr("action",data["removeAction"]);
            });

            $(element)
                .closest("form")
                .on("submit", function (e) {
                    $el.closest(".block").addClass("block-mode-loading");
                    $(menu_form_data).val(JSON.stringify(menuToJSON(design)));
                });
            
            var drag = Dragula([...element.children], {
                isContainer: function (el) {
                    return (
                        el.classList.contains("block-content") &&
                        !jQuery(el).closest(".gu-transit").length &&
                        !!jQuery(el).closest("#design").length
                    );
                },
                accepts: function (el, target) {
                    return (
                        !jQuery(target).closest("#elements").length &&
                        !jQuery(target).closest(".salt").length
                    );
                },
                copy: function (el, source) {
                    return source.id == "elements";
                },
                invalid: function (el, handle) {
                    return jQuery(el).closest(".salt").length;
                },
                //removeOnSpill: true,
                slideFactorX: 20,
                slideFactorY: 20,
            });

            drag.on("drop", jQuery.fn.trigger.bind(jQuery(element), "dirty"));
        });

        function initData(i, el) {
            let $el = jQuery(el);
            let childData = $el.data("data");
            if (!childData) return;
            childData.forEach((data) => {
                renderChildren($el, data);
            });
        }

        function renderChildren($el, data) {
            let template = block_template.content.cloneNode(true);
            let children = data["children"] ?? false;
            delete data["children"];
            $(".block", template).data("data", data).attr("id","menu" + data["id"]);
            let name = data["detail"] && data["detail"]["name"] ? data["detail"]["name"] : data["id"];
            $(".block-title", template).text(name);
            let $content = $(".block-content", template);
            if (data[":salt"]) $content.addClass("salt");
            if (!children) {
                $content.remove();
                $("[data-action=content_toggle]", template).remove();
            } else {
                children.forEach((child) => {
                    renderChildren($content, child);
                });
            }
            $el.append(template);
        }

        function menuToJSON(node, $children = []) {
            jQuery(">:hasData(data)", node).each(function (ind, elm) {
                var $c = menuToJSON(jQuery(">.block-content", elm));
                var c = [];
                if ($c.length > 0) {
                    c["children"] = $c;
                }
                var data = jQuery(elm).data("data");
                delete data["lft"];
                delete data["rgt"];
                delete data["status"];
                delete data["extras"];
                delete data["detail"];
                delete data["editAction"];
                delete data["removeAction"];
                $children.push({
                    ...data,
                    ...c,
                });
            });
            return $children;
        }
    }

    generateId() {
        return "op" + Math.random().toString(36).replace(/[^a-zA-Z0-9]+/g, '').substr(2, 10);
    }

    initRepeaterPanel() {
        jQuery("[data-repeater-count]:not(.js-repeater-enabled)")
            .addClass("js-repeater-enabled")
            .each((i, el) => {
                var $el = jQuery(el);
                var $uls = jQuery(">ul", el);
                $uls.removeClass("nav-justified");
                var $plus = $uls.prepend(
                    '<li class="nav-item" data-repeater-add><a class="nav-link" href="#" role="tab"><i class="fa fa-fw fa-plus small"></i></a></li>'
                );
                var $remove = $uls.prepend(
                    '<li class="nav-item" data-repeater-remove><a class="nav-link" href="#" role="tab"><i class="fa fa-fw fa-trash small"></i></a></li>'
                );
                
                var clonedForm = jQuery('>.tab-content >.tab-pane.active',$el).clone(true,true).removeClass('active');
                jQuery('[selected]',clonedForm).removeAttr('selected');
                jQuery('[checked]',clonedForm).removeAttr('checked');
                jQuery('input:not([type=checkbox]):not([type=radio])',clonedForm).removeAttr('value');
                
                function ReorderInputs(){
                    $el.data("repeater-names").forEach((n,i)=>{
                        jQuery('[name^="'+n+'"]',$el).each((i,e)=>{
                            jQuery(e).attr('name',n+'['+i+']');
                        });
                    });
                }

                $uls.on("click", "[data-repeater-remove]", (e) => { e.preventDefault(); });
                $uls.on("click", "[data-repeater-add]", (e) => {
                    e.preventDefault();
                    var count = $el.data("repeater-count") + 1;
                    $el.data("repeater-count", count);
                    var id = this.generateId();
                    $uls.append(
                            '<li class="nav-item"><a class="nav-link" href="#' +
                                id +
                                '" data-toggle="tab" role="tab">' +
                                count +
                                "</a></li>"
                        );
                    jQuery('>.tab-content',$el).append(clonedForm.attr("id",id).clone(true,true));
                    ReorderInputs();
                });
                
                var ul = $uls.get(0);
                var drag = Dragula([ul], {
                    direction: "horizontal",
                    revertOnSpill:true,
                    mirrorContainer: ul,
                    ignoreInputTextSelection: false,
                    slideFactorX: 20,
                    slideFactorY: 20,
                    moves: function (el, source, handle, sibling) {
                        return el.classList.contains("nav-item") &&
                        !(el.dataset.hasOwnProperty("repeaterRemove") || el.dataset.hasOwnProperty("repeaterAdd"));
                    },
                    accepts: function(el, target, source, sibling){
                        return sibling && !(sibling.dataset.hasOwnProperty("repeaterAdd"));
                    }
                });
    
                drag.on("drop", function(el, target, source, sibling){
                    $uls.trigger("dirty");
                    var $currentForm = jQuery(jQuery("a",el).attr("href"));
                    //Remove
                    if(sibling.dataset.hasOwnProperty("repeaterRemove")){
                        $currentForm.remove();
                        jQuery(el).remove();
                        if(jQuery(".active",el).length>0){
                            jQuery("li:nth-child(3)>a",$uls).tab('show');
                        }
                        ReorderInputs();
                        return;
                    }
                    //Reorder
                    if(!sibling.classList.contains("gu-mirror")){
                        var $siblingForm = jQuery(jQuery("a",sibling).attr("href"));
                        $siblingForm.before($currentForm.detach());
                    }else{
                        var $tabContent = $currentForm.closest('.tab-content');
                        $tabContent.append($currentForm.detach());
                    }
                    ReorderInputs();
                });
            });
    }

    initPopoverRemove() {
        if(!window.block_remove_form_template)
        {
            return;
        }
        var content = block_remove_form_template.content;
        var title = jQuery(block_remove_form_template).data('title');
        jQuery(".js-destroy:not(.js-destroy-enabled)")
            .addClass("js-destroy-enabled")
            .each((i, el) => {
                var $el = jQuery(el);
                var $form = jQuery('form',$el);
                $el.popover({
                    container: 'body',
                    boundary: 'window',
                    placement: 'auto',
                    html: true,
                    trigger: $el.is("[data-destroy]") ? 'click':'focus',
                    title,
                    template:'<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-header py-1 bg-body"></h3><div class="popover-body pt-1"></div></div>',
                    content:function(){
                        var $con = jQuery(content.cloneNode(true).children);
                        $con.on('click','[data-submit]',()=>$form.submit());
                        $con.on('click','[data-close]',()=>$el.popover("hide"));
                        return $con;
                    }
                })
                .on("click",e=>e.preventDefault());
            });
    }

    initFormAction() {
        if(!window.block_remove_form_template)
        {
            return;
        }
        jQuery(".js-action:not(.js-action-enabled)")
            .addClass("js-action-enabled")
            .each((i, el) => {
                var $el = jQuery(el);
                var $form = jQuery('form',$el);
                $el.on("click",e=>{
                    e.preventDefault();
                    $form.submit();
                });
            });
    }

    editor() {
        jQuery(".js-editor:not(.js-editor-enabled)").each(
            (index, element) => {
                var $el = jQuery(element).addClass("js-editor-enabled");
                var form = $el.closest("form");
                var editor = new Quill(element, {
                    modules: {
                        blotFormatter: {},
                        toolbar: [
                            [{ header: [1, 2, false] }],
                            ["bold", "italic", "underline","image"],
                        ],
                    },
                    theme: "snow",
                });

                form.on("submit", function (e) {
                    var $input = jQuery("<input type=hidden name='" + $el.data("name") + "' />");
                    $input.val(editor.root.innerHTML);
                    jQuery(this).append($input);
                });
            }
        );
    }

    textarea() {
        jQuery("textarea:not(.js-textarea-enabled)").each((index, element) => {
            var $el = jQuery(element).addClass("js-textarea-enabled");
            if ($el.data("auto-height")) {
                element.style.height = "5px";
                element.style.height = element.scrollHeight + 10 + "px";
            }
        });
    }

    toast() {
        jQuery("[data-toast]:not(.js-toast-enabled)").each((index, element) => {
            jQuery(element).addClass("js-toast-enabled").toast('show');
        });
    }
}
window.$ = window.jQuery = jQuery;
jQuery(() => new App());
