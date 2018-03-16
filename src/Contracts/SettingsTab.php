<?php
/**
 * Contains the SettingsTab interface.
 *
 * @copyright   Copyright (c) 2018 Attila Fulop
 * @author      Attila Fulop
 * @license     MIT
 * @since       2018-03-13
 *
 */


namespace Konekt\AppShell\Contracts;


use Illuminate\Support\Collection;

interface SettingsTab extends SettingsSlice
{
    /**
     * The setting groups within the tab
     *
     * @return Collection
     */
    public function groups() : Collection;
}