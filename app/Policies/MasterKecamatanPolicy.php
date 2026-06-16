<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\MasterKecamatan;
use Illuminate\Auth\Access\HandlesAuthorization;

class MasterKecamatanPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:MasterKecamatan');
    }

    public function view(AuthUser $authUser, MasterKecamatan $masterKecamatan): bool
    {
        return $authUser->can('View:MasterKecamatan');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:MasterKecamatan');
    }

    public function update(AuthUser $authUser, MasterKecamatan $masterKecamatan): bool
    {
        return $authUser->can('Update:MasterKecamatan');
    }

    public function delete(AuthUser $authUser, MasterKecamatan $masterKecamatan): bool
    {
        return $authUser->can('Delete:MasterKecamatan');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:MasterKecamatan');
    }

    public function restore(AuthUser $authUser, MasterKecamatan $masterKecamatan): bool
    {
        return $authUser->can('Restore:MasterKecamatan');
    }

    public function forceDelete(AuthUser $authUser, MasterKecamatan $masterKecamatan): bool
    {
        return $authUser->can('ForceDelete:MasterKecamatan');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:MasterKecamatan');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:MasterKecamatan');
    }

    public function replicate(AuthUser $authUser, MasterKecamatan $masterKecamatan): bool
    {
        return $authUser->can('Replicate:MasterKecamatan');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:MasterKecamatan');
    }

}