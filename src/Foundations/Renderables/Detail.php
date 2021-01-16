<?php

namespace Orbitali\Foundations\Renderables;

use Orbitali\Foundations\Html\BaseElement;

class Detail extends BaseElement
{
    protected $tag = "div";

    //TODO: override render function change inside names of input and clone all for all active languages
    public function render()
    {
        $this->class([
            "js-wizard-simple",
            "block",
            "block-rounded",
            "block-bordered",
        ]);

        //$this->addChild();
        /*
            <ul class="nav nav-tabs nav-tabs-alt nav-justified" role="tablist">
                <li class="nav-item"><a class="nav-link show" href="#detail_tr" data-toggle="tab">1. Personal</a></li>
            </ul>
            <div class="block-content block-content-full tab-content" style="min-height: 290px;">
                <div class="tab-pane active" id="detail_tr" role="tabpanel">

                    <div class="form-group">
                        <label for="wizard-simple2-firstname">First Name</label>
                        <input class="form-control form-control-alt" type="text" id="wizard-simple2-firstname" name="firstname" value="Umut">
                    </div>

                </div>
            </div>
        */
        return parent::render();
    }
}
