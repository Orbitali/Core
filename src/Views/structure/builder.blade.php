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
                    <button type="button" class="btn-block-option"><i class="si si-settings"></i></button>
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
                    <button type="button" class="btn-block-option"><i class="si si-settings"></i></button>
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

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dragula/3.7.2/dragula.js"></script>

    <script>
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

@endsection

@section('styles')
    <style>
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
@endsection

