<?php

    function initTable(){
    echo "<table>
      <tr>
        <th>Identifier</th>
        <th>Value</th>
        <th>Shortcode</th>
        <th>Add custom Css</th>
      </tr>";
    }

    function insertInTable($id,$key,$value){
        echo '<tr>
        <td>'.$key.'</td>
        <td>'.$value.'</td>
        <td>[FireCapture id="'.$id.'" name="'.$key.'"]</td>
        <td></td>
        </tr>';
    }

    function closeTable(){
        echo "</table>";
    }
?>