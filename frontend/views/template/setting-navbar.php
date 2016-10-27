<div class="col-md-3 md-margin-bottom-40">
    <ul class="list-group sidebar-nav-v1 margin-bottom-40" id="sidebar-nav-1">
        <li class="list-group-item <?= $type=='username'? 'active':''?>">
            <a href="/settings/change_username"><i class="fa fa-user"></i> Change username</a>
        </li>
        <li class="list-group-item <?= $type=='password'? 'active':''?>">
            <a href="/settings/change_password"><i class="fa fa-cog"></i> Change password</a>
        </li>
        <li class="list-group-item <?= $type=='avatar'? 'active':''?>">
            <a href="/settings/change_avatar"><i class="fa fa-cog"></i> Change avatar</a>
        </li>
        <li class="list-group-item <?= $type=='social'? 'active':''?>">
            <a href="/settings/connect_social"><i class="fa fa-globe"></i> Connect to social network</a>
        </li>
    </ul>
</div>