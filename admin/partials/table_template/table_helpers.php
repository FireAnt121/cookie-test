<?php

    function initTable(){
    echo "<table>
      <tr>
        <th>Identifier</th>
        <th>Value</th>
        <th>Shortcode</th>
      </tr>";
    }

    function insertInTable($key,$value){
        echo '<tr>
        <td>'.$key.'</td>
        <td>'.$value.'</td>
        <td>[FireCapture name="'.$key.'"]</td>
        </tr>';
    }

    function closeTable(){
        echo "</table>";
    }
?>