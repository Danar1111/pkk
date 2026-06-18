<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\User;
use App\Models\AnnualReportSetting;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnnualReportSettingPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(User $user): bool
    {
        return $user->hasRole(['super_admin', 'Admin_Sistem']);
    }

    public function view(User $user, AnnualReportSetting $record): bool
    {
        return $user->hasRole(['super_admin', 'Admin_Sistem']);
    }

    public function create(User $user): bool
    {
        return $user->hasRole(['super_admin', 'Admin_Sistem']);
    }

    public function update(User $user, AnnualReportSetting $record): bool
    {
        return $user->hasRole(['super_admin', 'Admin_Sistem']);
    }

    public function delete(User $user, AnnualReportSetting $record): bool
    {
        return false; // settings record should not be deleted
    }
}
