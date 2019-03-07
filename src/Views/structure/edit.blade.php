@extends("Orbitali::inc.app")

@section('content')
    <div class="row">
        <div class="col">
            <form id="structure_form" class="float-right" method="POST">
                @csrf
                <input name="_method" type="hidden" value="PUT">
                <input id="structure_form_data" type="hidden" name="data">
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    <div class="row">
        @php
            $children = [
                [ ":tag" => "div",":salt"=>true,":title"=>"Status", "class"=>"form-group", ":children"=>[
                        [":tag" => "label",'class'=>'d-block',":content"=>"Status"],
                        [":tag" => "div", "class"=>"custom-control custom-control-inline custom-radio custom-control-success", ":children"=>[
                                 [":tag" => "input",'type' => 'radio','id'=>'active','name'=>'status',':value'=>'1','class'=>"custom-control-input"],
                                 [":tag" => "label",'for'=>'active', ':content'=>'Active', 'class' => 'custom-control-label'],
                         ]],
                         [":tag" => "div", "class"=>"custom-control custom-control-inline custom-radio custom-control-danger", ":children"=>[
                                 [":tag" => "input",'type' => 'radio','id'=>'passive','name'=>'status',':value'=>'0','class'=>"custom-control-input"],
                                 [":tag" => "label",'for'=>'passive', ':content'=>'Passive', 'class' => 'custom-control-label'],
                         ]],
                         [":tag" => "div", "class"=>"custom-control custom-control-inline custom-radio custom-control-dark", ":children"=>[
                                 [":tag" => "input",'type' => 'radio','id'=>'draft','name'=>'status',':value'=>'2','class'=>"custom-control-input"],
                                 [":tag" => "label",'for'=>'draft', ':content'=>'Draft', 'class' => 'custom-control-label'],
                         ]],
                    ]
                ],
                [ ":tag" => "div",":salt"=>true,":title"=>"Order", "class"=>"form-group", ":children"=>[
                        [":tag" => "label",'for' => 'order',":content"=>"Order"],
                        [":tag" => "input",'type' => 'number','name'=>'order','class'=>"form-control",":rules"=>["required","numeric"]],
                    ]
                ],
                ///
                [ ":tag" => "detail",":title"=>"detail", ":children" => [] ],
                [ ":tag" => "input", 'type' => 'text',":title"=>"Text"],
                [ ":tag" => "label", 'for' => 'id',":title"=>"Label"],
                [ ":tag" => "input", 'type' => 'password',":title"=>"Password"],
                [ ":tag" => "input", 'type' => 'email',":title"=>"Email"],
                [ ":tag" => "input", 'type' => 'file',":title"=>"File"],
                [ ":tag" => "input", 'type' => 'checkbox',":title"=>"Checkbox"],
                [ ":tag" => "input", 'type' => 'radio',":title"=>"Radio"],
                [ ":tag" => "textarea",":title"=>"Textarea"],
                [ ":tag" => "select", ":children" => [],":title"=>"Select"],
                [ ":tag" => "div", ":children" => [],":title"=>"Div"],
                [ ":tag" => "div", "class"=>"form-group",":title"=>"Form Group", ":children" => [
                    [ ":tag" => "label", 'for' => 'id',":title"=>"Label"],
                    [ ":tag" => "input", 'type' => 'text',":title"=>"Text"],
                ]],
            ];

            function arrayEx(&$child)
            {
                return array_filter($child, function ($key) {
                    return $key[0] != ':';
                }, ARRAY_FILTER_USE_KEY);
            }

            function renderTemplate($children)
            {
                $children = $children??[];
                $template = "";
                foreach ($children as $child) {
                    $data = json_encode(array_except($child,':children'));
                    $title = studly_case(isset($child[':title']) ? $child[':title'] : $child[':tag']);
                    //col-6 d-inline-block float-left clearfix px-0
                    $template .=
                        <<<"HTML"
            <div class="block block-rounded my-1 mx-0 overflow-hidden" data-data='$data'>
HTML;

                    if (isset($child[':children']) && is_array($child[':children'])) {
                        $subChildren = renderTemplate($child[':children']);
                        $salt = isset($child[':salt'])?" salt":"";
                        $template .=
                            <<<"HTML"
            <div class="block-header block-header-default py-1">
                <h3 class="block-title">$title</h3>
                <div class="block-options">
                    <button type="button" class="btn-block-option" data-action="setting"><i class="si si-settings"></i></button>
                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                </div>
            </div>
            <div class="block-content p-2$salt">$subChildren</div>
HTML;
                    } else {
                        $template .= <<<HTML
            <div class="block-header block-header-default py-1">
                <h3 class="block-title">$title</h3>
                <div class="block-options">
                    <button type="button" class="btn-block-option" data-action="setting"><i class="si si-settings"></i></button>
                </div>
            </div>
HTML;
                    }
                    $template .= "</div>";
                }
                return $template;
            }
        @endphp
        <div id="visual_design" class="col-sm-8 pr-sm-1 px-0 pb-7 gu-unselectable">
            {!! renderTemplate($structure) !!}
        </div>


        <div id="visual_elements" class="col-sm-4 pl-sm-1 px-0 gu-unselectable">
            {!! renderTemplate($children) !!}
        </div>

    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dragula/3.7.2/dragula.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.all.min.js"></script>

    <template id="block_template">
        <div class="block block-rounded my-1 mx-0 overflow-hidden" data-data='{json}'>
            <div class="block-header block-header-default py-1">
                <h3 class="block-title">{title}}</h3>
                <div class="block-options">
                    <button type="button" class="btn-block-option"><i class="si si-settings"></i></button>
                    <button type="button" class="btn-block-option" data-toggle="block-option"
                            data-action="content_toggle"></button>
                </div>
            </div>
            <div class="block-content p-2{salt}">{children}</div>
        </div>
    </template>

    <script>
        function htmlParser(html) {
            var t = document.createElement('template');
            t.innerHTML = html;
            return t.content.childNodes;
        }

        function bodyParser(d, i, p, r = []) {
            for (i = 0; i < d.length; i++) {
                p = {":tag": d[i].nodeName.toLowerCase()};
                [].slice.call(d[i].attributes).forEach((t) => p[t.name] = t.value);
                if (d[i].value)
                    p[":value"] = d[i].value;
                if (d[i].firstChild && d[i].firstChild.nodeType == 3)
                    p[":content"] = d[i].firstChild.nodeValue.trim();
                if ((c = bodyParser(d[i].children)).length)
                    p[":children"] = c;
                r.push(p);
            }
            return r;
        }

        function toJSON(node, $children = []) {
            $('>[data-data]', node).each(function (ind, elm) {
                var $c = toJSON($('>.block-content', elm));
                var c = [];
                if ($c.length > 0) {
                    c[":children"] = $c;
                }
                $children.push({":tag": elm.nodeName.toLowerCase(), ...JSON.parse(elm.dataset.data), ...c});
            });
            return $children;
        }

        $(structure_form).submit(function () {
            $(structure_form_data).val(JSON.stringify(toJSON(visual_design)));
        });

        $('[data-action=setting]').on('click', function () {
            var $data_elm = $(this).closest('[data-data]');
            showModel();
            // $data_elm.attr('data-data', JSON.stringify(data)); //set
            // $data_elm.data('data'); //get
        });

        function rulesInput(selecteds) {
            var $id = Math.random().toString(36).slice(2);
            var $html = `<div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <select id="` + $id + `" class="w-100" data-placeholder="Rules" multiple>
                                    <option value="accepted">accepted</option>
                                    <option value="active_url">active_url</option>
                                    <option value="" disabled="disabled">after:date</option>
                                    <option value="" disabled="disabled">after_or_equal:date</option>
                                    <option value="alpha">alpha</option>
                                    <option value="alpha_dash">alpha_dash</option>
                                    <option value="alpha_num">alpha_num</option>
                                    <option value="array">array</option>
                                    <option value="bail">bail</option>
                                    <option value="" disabled="disabled">before:date</option>
                                    <option value="" disabled="disabled">before_or_equal:date</option>
                                    <option value="" disabled="disabled">between:min,max</option>
                                    <option value="boolean">boolean</option>
                                    <option value="checkbox">checkbox</option>
                                    <option value="confirmed">confirmed</option>
                                    <option value="date">date</option>
                                    <option value="" disabled="disabled">date_equals:date</option>
                                    <option value="" disabled="disabled">date_format:format</option>
                                    <option value="" disabled="disabled">different:field</option>
                                    <option value="" disabled="disabled">digits:value</option>
                                    <option value="" disabled="disabled">digits_between:min,max</option>
                                    <option value="dimensions">dimensions</option>
                                    <option value="distinct">distinct</option>
                                    <option value="email">email</option>
                                    <option value="" disabled="disabled">exists:table,column</option>
                                    <option value="file">file</option>
                                    <option value="filled">filled</option>
                                    <option value="" disabled="disabled">gt:field</option>
                                    <option value="" disabled="disabled">gte:field</option>
                                    <option value="image">image</option>
                                    <option value="" disabled="disabled">in:foo,bar,...</option>
                                    <option value="" disabled="disabled">in_array:anotherfield.*</option>
                                    <option value="integer">integer</option>
                                    <option value="ip">ip</option>
                                    <option value="ipv4">ipv4</option>
                                    <option value="ipv6">ipv6</option>
                                    <option value="json">json</option>
                                    <option value="" disabled="disabled">lt:field</option>
                                    <option value="" disabled="disabled">lte:field</option>
                                    <option value="" disabled="disabled">max:value</option>
                                    <option value="" disabled="disabled">mimetypes:text/plain,...</option>
                                    <option value="" disabled="disabled">mimes:foo,bar,...</option>
                                    <option value="" disabled="disabled">min:value</option>
                                    <option value="" disabled="disabled">not_in:foo,bar,...</option>
                                    <option value="" disabled="disabled">not_regex:pattern</option>
                                    <option value="nullable">nullable</option>
                                    <option value="numeric">numeric</option>
                                    <option value="present">present</option>
                                    <option value="" disabled="disabled">regex:pattern</option>
                                    <option value="required">required</option>
                                    <option value="" disabled="disabled">required_if:anotherfield,value,...</option>
                                    <option value="" disabled="disabled">required_unless:anotherfield,value,...</option>
                                    <option value="" disabled="disabled">required_with:foo,bar,...</option>
                                    <option value="" disabled="disabled">required_with_all:foo,bar,...</option>
                                    <option value="" disabled="disabled">required_without:foo,bar,...</option>
                                    <option value="" disabled="disabled">required_without_all:foo,bar,...</option>
                                    <option value="" disabled="disabled">same:field</option>
                                    <option value="" disabled="disabled">size:value</option>
                                    <option value="" disabled="disabled">starts_with:foo,bar,...</option>
                                    <option value="string">string</option>
                                    <option value="timezone">timezone</option>
                                    <option value="" disabled="disabled">unique:table,column,except,idColumn</option>
                                    <option value="url">url</option>
                                    <option value="uuid">uuid</option>
                                </select>
                            </div>
                        </div>
                    </div>`;
            var $script = (content) => {
                var el = $('#' + $id, content);
                el.select2({
                    tags: true, width: '100%', tokenSeparators: ['|', ' '],
                    data: selecteds
                }).select2('val', selecteds);
                el.on("select2:select", function (evt) {
                    var element = evt.params.data.element;
                    var $element = $(element);
                    $element.detach();
                    $(this).append($element);
                    $(this).trigger("change");
                });
            };
            return [$html, $script];
        }

        function showModel() {
            var $rules = rulesInput(["email", "max:12"]);
            Swal.fire({
                html: $rules[0],
                showCloseButton: true,
                showCancelButton: true,
                focusConfirm: true,
                confirmButtonText: '<i class="fas fa-save"></i>',
                confirmButtonAriaLabel: 'Submit',
                cancelButtonText: '<i class="fas fa-cross"></i>',
                cancelButtonAriaLabel: 'Cancel',
                onBeforeOpen: () => {
                    const content = Swal.getContent();
                    $rules[1](content);
                },
            });
        }

    </script>

    <script type="text/javascript">
        var drake = dragula([document.getElementById('visual_elements'), document.getElementById('visual_design')], {
            isContainer: function (el) {
                return $(el).hasClass('block-content');
            },
            accepts: function (el, target) {
                return !$(target).closest('#visual_elements').length && !$(target).closest('.salt').length;
            },
            copy: function (el, source) {
                return $(el).closest('#visual_elements').length;
            },
            invalid: function (el, handle) {
                return $(el).closest('.salt').length;
            },
            removeOnSpill: true,
        });
    </script>

@endpush

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">

    <style>
        .swal2-container {
            z-index: 1000 !important;
        }

        .block {
            background: rgba(0, 0, 0, .04);
        }

        .salt, .salt .block {
            background: rgba(255, 0, 0, .04);
        }

        .gu-mirror {
            position: fixed !important;
            margin: 0 !important;
            z-index: 9999 !important;
            opacity: 0.8;
            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=80)";
            filter: alpha(opacity=80);
        }

        .gu-hide {
            display: none !important;
        }

        .gu-unselectable {
            -webkit-user-select: none !important;
            -moz-user-select: none !important;
            -ms-user-select: none !important;
            user-select: none !important;
        }

        .gu-transit {
            opacity: 0.4;
            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=20)";
            filter: alpha(opacity=40);
        }
    </style>
@endpush

