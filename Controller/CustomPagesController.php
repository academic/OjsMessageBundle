<?php

namespace Okulbilisim\MessageBundle\Controller;

use Okulbilisim\MessageBundle\Controller\BaseController as Controller;

class CustomPagesController extends Controller {

    /**
     *
     * @access protected
     * @return RenderResponse
     */
    public function showLicenceAction() {

        return $this->renderResponse('OkulbilisimMessageBundle::licence.html.');
    }

}
