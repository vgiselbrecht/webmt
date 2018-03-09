<?php 
class end
{
    function JS()
    {
        ?>
        <script>
        function del(table, id){
        var eingabe=confirm ("<?php echo $GLOBALS['lang']['delete']; ?>")
            if(eingabe==true){
                window.location.href = "?id=<?php echo $_REQUEST['id']; ?>&del=true&table="+table+"&dataid="+id;
                }
            }
        </script>
        <?php 
    }
}

 ?>