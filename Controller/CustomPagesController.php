<?php

namespace OjstrMessage\MessageBundle\Controller;

use OjstrMessage\MessageBundle\Controller\BaseController as Controller;

class CustomPagesController extends Controller {

    /**
     *
     * @access protected
     * @return RenderResponse
     */
    public function showLicenceAction() {

        return $this->renderResponse('OjstrMessageMessageBundle::licence.html.');
    }

}
