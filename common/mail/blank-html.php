<?php
use yii\helpers\Url;

?>
<!-- Wrapper -->
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
    <tr>
        <td width="100%" valign="top" bgcolor="#ffffff" style="padding-top:20px">

            <!--Start Header-->
            <table width="700" bgcolor="#fff" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
                <tr>
                    <td style="padding: 6px 0px 0px">
                        <table width="650" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
                            <tr>
                                <td width="100%" >
                                    <!--Start logo-->
                                    <table  border="0" cellpadding="0" cellspacing="0" align="left" class="deviceWidth">
                                        <tr>
                                            <td class="center" style="padding: 20px 0px 10px 0px">
                                                <a href="<?= Yii::$app->params['domain']?>">
                                                    <img src="<?= Yii::$app->params['domain']?>/img/logo-drank.png" alt="logo">
                                                </a>
                                            </td>
                                        </tr>
                                    </table><!--End logo-->
                                    <!--Start nav-->
                                    <table  border="0" cellpadding="0" cellspacing="0" align="right" class="deviceWidth">
                                        <tr>
                                            <td  class="center" style="font-size: 13px; color: #272727; font-weight: bold; text-align: center; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 0px 10px 0px;">
                                                <a href="<?= Yii::$app->params['domain']?>" style="text-decoration: none; color: #3b3b3b;">HOME</a>
                                                &nbsp; &nbsp;
                                            </td>
                                        </tr>
                                    </table><!--End nav-->
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <!--End Header-->
            <!--Start Discount-->
            <table width="700" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
                <tr>
                    <td width="100%" style=" padding: 20px 0;" align="center" bgcolor="#f7f7f7">
                        <!--Left Box-->
                        <table   border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
                            <tr>
                                <td valign="top" class="left" style="font-size: 16px; color: #303030; font-weight: bold; text-align: center; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 0 20px 10px 20px;">
                                    Hi, <?= $content?>
                                </td>
                            </tr>
                        </table><!--End Left Box-->

                    </td>
                </tr>
            </table>
            <!--End Discount-->

            <!-- Footer -->
            <table width="700"  border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
                <tr>
                    <td class="center" style="font-size: 12px; color: #687074; font-weight: bold; text-align: center; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 50px 0px 50px; ">
                        Copyright � Movie 2014
                    </td>
                </tr>
            </table>
            <!--End Footer-->

            <div style="height:15px">&nbsp;</div><!-- divider-->


        </td>
    </tr>
</table>
<!-- End Wrapper -->