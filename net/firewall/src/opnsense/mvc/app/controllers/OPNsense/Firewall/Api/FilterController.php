<?php

/*
 * Copyright (C) 2020 Deciso B.V.
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 * 1. Redistributions of source code must retain the above copyright notice,
 *    this list of conditions and the following disclaimer.
 *
 * 2. Redistributions in binary form must reproduce the above copyright
 *    notice, this list of conditions and the following disclaimer in the
 *    documentation and/or other materials provided with the distribution.
 *
 * THIS SOFTWARE IS PROVIDED ``AS IS'' AND ANY EXPRESS OR IMPLIED WARRANTIES,
 * INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY
 * AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 * AUTHOR BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY,
 * OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 */
namespace OPNsense\Firewall\Api;

use OPNsense\Base\ApiMutableModelControllerBase;
use OPNsense\Core\Backend;

class FilterController extends ApiMutableModelControllerBase
{
    protected static $internalModelName = 'filter';
    protected static $internalModelClass = 'OPNsense\Firewall\Filter';

    public function searchItemAction()
    {
        return $this->searchBase("rules.rule", array('enabled', 'sequence', 'description'), "sequence");
    }

    public function setItemAction($uuid)
    {
        return $this->setBase("rule", "rules.rule", $uuid);
    }

    public function addItemAction()
    {
        return $this->addBase("rule", "rules.rule");
    }

    public function getItemAction($uuid = null)
    {
        return $this->getBase("rule", "rules.rule", $uuid);
    }

    public function delItemAction($uuid)
    {
        return $this->delBase("rules.rule", $uuid);
    }

    public function toggleItemAction($uuid, $enabled = null)
    {
        return $this->toggleBase("rules.rule", $uuid, $enabled);
    }

    public function applyAction()
    {
        if ($this->request->isPost()) {
            return array("status" => (new Backend())->configdRun('filter reload'));
        } else {
            return array("status" => "error");
        }
    }
}