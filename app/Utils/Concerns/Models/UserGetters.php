<?php

namespace App\Utils\Concerns\Models;

use App\Models\Auth\Role;

trait UserGetters
{
    /**
     * user has super-admin role ?
     *
     * @return bool
     */
    public function isSuperAdmin()
    {
        return Role::ROLE_SUPER_ADMIN === $this->role_id;
    }

    /**
     * user has manager role ?
     *
     * @return bool
     */
    public function isManager()
    {
        return Role::ROLE_MANAGER === $this->role_id;
    }

    /**
     * user has forum manager role ?
     *
     * @return bool
     */
    public function isForumManager()
    {
        return Role::ROLE_FORUM_MANAGER === $this->role_id;
    }
}
