<?php 
if(isset($_GET['csvn']))
{
    header('location:smanage.php?csvn');
}elseif(isset($_GET['regs']))
{
    header('location:smanage.php?regs');
}if(isset($_GET['vwstdr']))
{
    header('location:smanage.php?vwstdr');
}if(isset($_GET['edits']))
{
    header('location:smanage.php?edits');
}if(isset($_GET['csvc']))
{
    header('location:smanage.php?csvc');
}if(isset($_GET['courser']))
{
    header('location:smanage.php?courser');
}if(isset($_GET['updtcourse']))
{
    header('location:smanage.php?updtcourse');
}if(isset($_GET['addviewwdit']))
{
    header('location:smanage.php?addviewwdit');
}if(isset($_GET['newpro']))
{
    header('location:smanage.php?newpro');
}if(isset($_GET['newcourse']))
{
    header('location:smanage.php?newcourse');
}if(isset($_GET['importpro']))
{
    header('location:smanage.php?importpro');
}if(isset($_GET['inputpro']))
{
    header('location:smanage.php?inputpro');
    
}if(isset($_GET['group']))
{
    header('location:smanage.php?group');
}if(isset($_GET['editgroup']))
{
    header('location:smanage.php?editgroup');
}if(isset($_GET['editprog']))
{
    header('location:smanage.php?editprog');

}if(isset($_GET['staff_user']))
{
    header('location:smanage.php?staff_user');

}if(isset($_GET['edituser_staff']))
{
    header('location:smanage.php?edituser_staff');
    
} if(isset($_GET['tusers']))
{
    header('location:smanage.php?tusers');
 }

?>