<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\MasterBidang;
use Illuminate\Auth\Access\HandlesAuthorization;

class MasterBidangPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:MasterBidang');
    }

    public function view(AuthUser $authUser, MasterBidang $masterBidang): bool
    {
        return $authUser->can('View:MasterBidang');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:MasterBidang');
    }

    public function update(AuthUser $authUser, MasterBidang $masterBidang): bool
    {
        return $authUser->can('Update:MasterBidang');
    }

    public function delete(AuthUser $authUser, MasterBidang $masterBidang): bool
    {
        return $authUser->can('Delete:MasterBidang');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:MasterBidang');
    }

    public function restore(AuthUser $authUser, MasterBidang $masterBidang): bool
    {
        return $authUser->can('Restore:MasterBidang');
    }

    public function forceDelete(AuthUser $authUser, MasterBidang $masterBidang): bool
    {
        return $authUser->can('ForceDelete:MasterBidang');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:MasterBidang');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:MasterBidang');
    }

    public function replicate(AuthUser $authUser, MasterBidang $masterBidang): bool
    {
        return $authUser->can('Replicate:MasterBidang');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:MasterBidang');
    }

}