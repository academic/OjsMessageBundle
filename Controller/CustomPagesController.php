<?php

namespace OjsMessage\MessageBundle\Controller;

use OjsMessage\MessageBundle\Controller\BaseController as Controller;

class CustomPagesController extends Controller {

    /**
     *
     * @access protected
     * @return RenderResponse
     */
    public function showLicenceAction() {

        return $this->renderResponse('OjsMessageMessageBundle::licence.html.');
    }

}
