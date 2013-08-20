<?php

 $db = new DataBase(); // Connect to the database.
 $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
       $stmt = $db->prepare('SELECT u_user FROM `'.$db->dbprefix().'chat` ORDER BY `u_id` ASC');
       $stmt->execute();
