<?php

namespace App\Models;

class Permission extends \Spatie\Permission\Models\Permission
{
    /**
     * Default Permissions of the Application.
     */
    public static function defaultPermissions()
    {
        return [
            'view_users',
            'add_users',
            'edit_users',
            'delete_users',
            'restore_users',
            'block_users',

            'view_roles',
            'add_roles',
            'edit_roles',
            'delete_roles',
            'restore_roles',

            'view_backups',
            'add_backups',
            'create_backups',
            'download_backups',
            'delete_backups',


            'view_projects',
            'add_projects',
            'edit_projects',
            'delete_projects',
            'restore_projects',

            'view_groups',
            'add_groups',
            'edit_groups',
            'delete_groups',

            'view_stages',
            'add_stages',
            'edit_stages',
            'delete_stages',

            'view_products',
            'add_products',
            'edit_products',
            'delete_products',

            'view_stage_groups',
            'add_stage_groups',
            'edit_stage_groups',
            'delete_stage_groups',


        ];
    }

    /**
     * Name should be lowercase.
     *
     * @param  string  $value  Name value
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtolower($value);
    }


    public static function userPermissions()
    {
        return [
            'view_projects',
            
            'view_groups',


            'view_stages',


            'view_products',


            'view_stage_groups',


        ];
    }
}
