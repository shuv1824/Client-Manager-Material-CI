<a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <i class="material-icons">notifications</i>
    <span class="notification" id="notification-count"><?php echo $num?></span>
    <p class="hidden-lg hidden-md">Notifications</p>
</a>

<ul class="dropdown-menu">
    <?php foreach($notifications as $index => $notification):?>
    <li style="text-decoration:none; <?php if($notification['is_read']==0) echo 'background-color:#ccc'?>">
        <a href="<?php echo $notification['link']?>" onclick="markAsRead(<?php echo $notification['id']?>)">
            <?php echo $notification['content']?>
        </a>
    </li>
        <?php if($index > 5) break;?>
    <?php endforeach;?>

    <div id="notification-footer">
        <a href="<?php echo base_url('notifications')?>">Go to all Notifications</a>
    </div>
</ul>