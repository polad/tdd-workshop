<?php

namespace Application\Model;

class Event {
    const ASSET_FAILED          = 'ASSET_FAILED';
    const ASSET_FAILED_ABRUPTLY = 'ASSET_FAILED_ABRUPTLY';
    const ASSET_MAY_FAIL        = 'ASSET_MAY_FAIL';
    const ASSET_RECOVERED       = 'ASSET_RECOVERED';
}