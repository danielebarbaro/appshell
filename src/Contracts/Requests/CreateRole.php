<?php
/**
 * Contains the CreateRole request interface.
 *
 * @copyright   Copyright (c) 2017 Attila Fulop
 * @author      Attila Fulop
 * @license     MIT
 * @since       2017-07-25
 *
 */


namespace Konekt\AppShell\Contracts\Requests;


interface CreateRole extends BaseRequest
{
    /**
     * Returns the permissions array
     *
     * @return array
     */
    public function permissions();

}