<!--user-->
@foreach($assigned as $user)
<?php
        $firstNameInitial = strtoupper(substr($user->first_name, 0, 1));
        $lastNameInitial = strtoupper(substr($user->last_name, 0, 1));
        $initials = $firstNameInitial . $lastNameInitial;
?>
<span class="x-assigned-user {{ runtimePermissions('task-assign-users', $task->permission_assign_users) }} card-task-assigned card-assigned-listed-user"
        tabindex="0" data-user-id="{{ $user->id }}" data-popover-content="card-task-team"
        data-title="{{ cleanLang(__('lang.assign_users')) }}">
        <div class="text-white bg-success img-circle avatar-xsmall text-center pt-1">
                    {{ $initials }}
       </div>
        
        <!-- <img
                src="{{ getUsersAvatar($user->avatar_directory, $user->avatar_filename) }}" data-toggle="tooltip"
                title="" data-placement="top" alt="{{ $user->first_name }}" class="img-circle avatar-xsmall"
                data-original-title="{{ $user->first_name }}"> -->
        
        </span>
@endforeach
<br />