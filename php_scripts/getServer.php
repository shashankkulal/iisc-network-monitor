<?php
include "db_config.php";
$q = $_GET['q'];
echo '<form id="addToMonitor" action="../speedtest/addToMonitor.php" method="post">';
echo '<select name="source" id="source" style="width:500px;" class="btn btn-sm btn-default">';
$rs = $db->query("select *from speedtest where sname like '%$q%' ");
while($row=$rs->fetch_array())
{
?>

    <option value="<?php echo $row['sid']; ?>"><?php echo $row['sname']; ?></option>

<?php
}
echo '</select><br><br>';

echo '<input type="submit" class="btn btn-sm btn-primary" id="insert" value="Add to Monitor >>" /></form>';
?>
