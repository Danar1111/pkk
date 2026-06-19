<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\LkpReport;
use Illuminate\Auth\Access\HandlesAuthorization;

class LkpReportPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:LkpReport');
    }

    public function view(AuthUser $authUser, LkpReport $lkpReport): bool
    {
        return $authUser->can('View:LkpReport');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:LkpReport');
    }

    public function update(AuthUser $authUser, LkpReport $lkpReport): bool
    {
        if (! $authUser->can('Update:LkpReport')) {
            return false;
        }

        if ($authUser->hasRole(['super_admin', 'Admin_Sistem', 'Pengurus_Inti', 'Staf_Ahli'])) {
            return true;
        }

        return $lkpReport->user_id === $authUser->id;
    }

    public function delete(AuthUser $authUser, LkpReport $lkpReport): bool
    {
        if (! $authUser->can('Delete:LkpReport')) {
            return false;
        }

        if ($authUser->hasRole(['super_admin', 'Admin_Sistem', 'Pengurus_Inti', 'Staf_Ahli'])) {
            return true;
        }

        return $lkpReport->user_id === $authUser->id;
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->hasRole(['super_admin', 'Admin_Sistem', 'Pengurus_Inti', 'Staf_Ahli']) 
            && $authUser->can('DeleteAny:LkpReport');
    }

    public function restore(AuthUser $authUser, LkpReport $lkpReport): bool
    {
        return $authUser->hasRole(['super_admin', 'Admin_Sistem', 'Pengurus_Inti', 'Staf_Ahli']) 
            && $authUser->can('Restore:LkpReport');
    }

    public function forceDelete(AuthUser $authUser, LkpReport $lkpReport): bool
    {
        return $authUser->hasRole(['super_admin', 'Admin_Sistem', 'Pengurus_Inti', 'Staf_Ahli']) 
            && $authUser->can('ForceDelete:LkpReport');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->hasRole(['super_admin', 'Admin_Sistem', 'Pengurus_Inti', 'Staf_Ahli']) 
            && $authUser->can('ForceDeleteAny:LkpReport');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->hasRole(['super_admin', 'Admin_Sistem', 'Pengurus_Inti', 'Staf_Ahli']) 
            && $authUser->can('RestoreAny:LkpReport');
    }

    public function replicate(AuthUser $authUser, LkpReport $lkpReport): bool
    {
        if (! $authUser->can('Replicate:LkpReport')) {
            return false;
        }

        if ($authUser->hasRole(['super_admin', 'Admin_Sistem', 'Pengurus_Inti', 'Staf_Ahli'])) {
            return true;
        }

        return $lkpReport->user_id === $authUser->id;
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:LkpReport');
    }

}