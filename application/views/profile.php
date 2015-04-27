<style  type="text/css">
    table {width: 700px;  border-radius:5px }
    table td { border-radius:5px}
</style>
<html>
    <head>
        <title><?php echo $title; ?></title>
    </head>
    <link rel="stylesheet" href="<?php echo $assessment_css ?>" />

    <?php $this->load->view('fancybox_scripts'); ?>
    <body>
        <div id="mainContainer">
            <?php $this->load->view('menu'); ?>
            <center>
                <h3>My Profile</h3>
                <center>
                    <?php
                    
                        foreach ($this->user->getFullUserDetail($this->session->userdata('user_id')) as $row){
                    ?>
                <table  cellpadding="4px" cellspacing="5px">
                    <tr>
                        <td width ="30%" ><b>Firstname: </b></td>
                        <td><?php echo $row->FIRST_NAME; ?></td>
                    </tr>
                    <tr>
                        <td ><b>Lastname: </b></td>
                        <td><?php echo $row->SURNAME; ?></td>
                    </tr>
                    <tr>
                        <td ><b>Email Address</b></td>
                        <td><?php echo $row->EMAIL; ?></td>
                    </tr>
                    <tr>
                        <td ><b>Date registered</b></td>
                        <td><?php echo $row->DATE_CREATED; ?></td>
                    </tr>
                    <tr>
                        <td ><b>Sex</b></td>
                        <td><?php echo $row->SEX; ?></td>
                    </tr>
                    <tr>
                        <td ><b>Institution</b></td>
                        <td><?php echo $row->INSTITUTION; ?></td>
                    </tr>
                    <tr>
                        <td ><b>COUNTRY</b></td>
                        <td><?php echo $row->COUNTRY; ?></td>
                    </tr>
                </table>
                    <?php
                        }
                    ?>
                </center>
            <div style="clear: both"></div>
            <br />

        </div>
        <div style="clear: both"></div>
        <?php $this->load->view('footer'); ?>
</body>
</html>
