<table>
    <tr>
        <th>User</th>
        <th>Roles</th>
        <th>Permissions</th>
    </tr>
    <?php foreach ($users as $user){ ?>
    <tr>
        <th>{{$user->name}}</th>

        <th><?php foreach ($user->roles as $role){ ?>
           <?php echo $role->name;
            echo '<br>';
            ?>
        <?php }?>
        </th>


        <th>
            <?php
                foreach ($user->roles as $role){
                    foreach ($role->permissions as $permission){
                        echo $permission->name;
                        echo "<br>";
                    }
                }
            ?>
        </th>
    </tr>
    <?php }?>
</table>

