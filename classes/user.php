<?php

class user extends model
{
    protected $table = '`user`';

    public static function loginForm() {
        ?>
            <form method="POST" onsubmit="submitForm(this, 'user.php')" prevent-default>
                <input name="action" type="hidden" value="login"/>
                <div class="form-group  ">
                    <input type="text" name="username" class="form-control" placeholder="Username" required>
                </div>
                <div class="form-group  ">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>

                <div class="text-center">
                    <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat">Login</button>
                </div>
            </form>
        <?php
    }

    public static function login($data) {
        
        $username = $data['username'];
        $password = $data['password'];
        $user     = user::where('username', $username);

        if (!empty($user) && $user['password'] == $password && $user['status'] == 1) {

            $_SESSION['userid']    = $user['id'];
            $_SESSION['username']  = $user['username'];
            $_SESSION['name']      = $user['name'];
            $_SESSION['user_type'] = $user['user_type_id'];
            $_SESSION['status']    = $user['status'];
            $_SESSION['branch_id'] = $user['branch_id'];

            $json["notifyDo"] = ["type" => "success", "msg" => "Logged in Successfully.", "redirectTo" => "index.php"];
            exit(json_encode($json, JSON_PRETTY_PRINT));

        } else {

            $json['notification'] = ["type" => "danger", "msg" => "Username or Password Incorrect."];
            exit(json_encode($json, JSON_PRETTY_PRINT));

        }
    }
}