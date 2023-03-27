
<!doctype html>
<html lang="en">

<head>
   
</head>

<style>
    input[type='text']{
        border-bottom: 1px solid yellow!important;
    }

    .btn{
        background-color: blue;
        color:#fff;
        padding: 9px 14px;
        margin: 10px 0;
        display: inline-block;
        text-decoration: none;
        font-family: Arial, Helvetica, sans-serif;

    }
   

</style>

<body>
   
    <div class="container-fluid marketing">
         <input type="hidden" name="id" value="<?= $releasedata[0]->id;?>">
        <div class="container superupper">
            <div class="row">
                <div class="col-md-12 pt-4 bg-white">
                    
                    <table cellpadding="0" cellspacing="0" width="100%" border="0" style="font-size: 12px; font-family:Arial, Helvetica, sans-serif;">
                        <tr>
                            <td>

                                <table cellpadding="0" cellspacing="0" width="100%" border="0" style="padding-bottom: 3px;">
                                    <tr>
                                        <td rowspan="2" width="210px" align="left" valign="top">
                                            <img src="https://www.ayushtv.com/assets/images/logopr.png" alt="" width="50px">
                                        </td>
                                        <td rowspan="2" align="center" valign="top">
                                            <h1 style="font-size:16px;">ADVERTISEMENT RELEASE ORDER</h1>
                                        </td>
                                        <td valign="top" width="210px" align="right">
                                            Date:<input type="text" style="border: none; border-bottom:1px solid #000;" name="date" value="<?= $releasedata[0]->rdate;?>"/>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td valign="top" width="210px" align="right">
                                            Place:<input type="text" style="border: none; border-bottom:1px solid #000;" name="place" value="<?= $releasedata[0]->place;?>"/>
                                        </td>
                                    </tr>
                                </table>


                                <table cellpadding="0" cellspacing="0" width="100%" border="0" style=" border-left:1px solid #000; border-top: 1px solid #000;">
                                    <tr>
                                        <td valign="top" style="width: 50%;  border-right:1px solid #000; border-bottom: 1px solid #000; padding:0;">
                                            <table cellpadding="0" cellspacing="0" width="100%" border="0">
                                                <tr>
                                                    <td valign="top" style="padding: 5px; line-height: 18px;">
                                                        <b> FROM</b><br>
                                                        Mr/Ms/Mrs. : <input type="text" style="border: none;" name="name" value="<?= $releasedata[0]->name;?>"/><br>
                                                        Designation : <input type="text" style="border: none;" name="designation" value="<?= $releasedata[0]->designation;?>" /><br>
                                                        Contact No. : <input type="number" style="border: none;" name="cno" value="<?= $releasedata[0]->cno;?>" /><br>
                                                        Client / Agency : <input type="text" style="border: none;" name="client" value="<?= $releasedata[0]->client;?>"/><br>
                                                        GST No. : <input type="text" style="border: none;" name="gstno" value="<?= $releasedata[0]->gstno;?>"/><br>
                                                        Address : <input type="text" style="border: none;" name="addr" value="<?= $releasedata[0]->addr;?>"/><br>

                                                        Email : <input type="text" style="border: none;" name="email" value="<?= $releasedata[0]->email;?>"/><br>
                                                        Website : <input type="text" style="border: none;" name="web" value="<?= $releasedata[0]->web;?>"/><br>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td valign="top" style="width: 50%; border-right:1px solid #000; border-bottom: 1px solid #000; padding: 5px; line-height: 18px;">
                                            <b>TO</b><br>
                                            <b>M/S Kamadhenu Telefilms Private Limited.</b><br>
                                            No. 8/5-2, New BEL Road, RMV 2nd Stage,<br>
                                            Bangalore-560 054.<br>
                                            E-Mail : marketing@ayushtv.in<br>
                                            Website : www.ayushtv.com<br>
                                            Contact No.:080-40011239<br>
                                            <b>GST NO.29AADCK1165A1ZX</b>
                                        </td>
                                    </tr>
                                </table>


                                <table cellpadding="0" cellspacing="0" width="100%" border="0" style=" padding: 5px">

                                    <tr>
                                        <td>M : <input type="text" style="border: none;" name="m" value="<?= $releasedata[0]->m;?>"/></td>
                                        <td align="center">Booked By : <input type="text" style="border: none;" name="bookedby"  value="<?= $releasedata[0]->bookedby;?>"/></td>
                                        <td align="right">R.O No; KTPLATV <input type="text" style="width: 100px; border:none; border-bottom:1px solid #000;" name="rono" value="<?= $releasedata[0]->rono;?>">/2022-23</td>
                                    </tr>
                                </table>



                                <table cellpadding="0" cellspacing="0" width="100%" border="0" style="">
                                    <tr>
                                        <td style="width:50%;" valign="top">
                                            <table cellpadding="0" cellspacing="0" width="100%" border="0" style="  border-right:1px solid #000; border-bottom:1px solid #000; font-size: 11px;">
                                                <tr>
                                                    <td style="padding:5px 5px; border-left: 1px solid #000; border-top: 1px solid #000; width: 150px;">
                                                        AD CAPTION
                                                    </td>
                                                    <td style="padding:0 5px; border-left: 1px solid #000; border-top: 1px solid #000;">
                                                        <input type="text" style="border: none; width: 100%;" name="adcap" value="<?= $releasedata[0]->adcap;?>"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding:5px 5px; border-left: 1px solid #000; border-top: 1px solid #000;">
                                                        DURATION OF AD
                                                    </td>
                                                    <td style="padding:0 5px; border-left: 1px solid #000; border-top: 1px solid #000;">
                                                        <input type="text" style="border: none; width: 100%;" name="dur" value="<?= $releasedata[0]->dur;?>"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding:5px 5px; border-left: 1px solid #000; border-top: 1px solid #000;">
                                                        NO. OF INSERTIONS
                                                    </td>
                                                    <td style="padding:0 5px; border-left: 1px solid #000; border-top: 1px solid #000;">
                                                        <input type="text" style="border: none; width: 100%;" name="noofinsertion" value="<?= $releasedata[0]->noofinsertion;?>"/>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td style="padding:5px 5px; border-left: 1px solid #000; border-top: 1px solid #000;">
                                                        TOTAL FCT
                                                    </td>
                                                    <td style="padding:0 5px; border-left: 1px solid #000; border-top: 1px solid #000;">
                                                        <input type="text" style="border: none; width: 100%;" name="totalfct"value="<?= $releasedata[0]->totalfct;?>" />
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td style="padding:5px 5px; border-left: 1px solid #000; border-top: 1px solid #000;">
                                                        ER
                                                    </td>
                                                    <td style="padding:0 5px; border-left: 1px solid #000; border-top: 1px solid #000;">
                                                        <input type="text" style="border: none; width: 100%;" name="er" value="<?= $releasedata[0]->er;?>"/>
                                                    </td>
                                                </tr>

                                            </table>

                                        </td>

                                        <td valign="top">
                                            <table cellpadding="0" cellspacing="0" width="100%" border="0" style=" padding: 5px; border-right:1px solid #000; border-top:1px solid #000; border-bottom:1px solid #000; font-size: 11px;">
                                                <tr>
                                                    <td colspan="5" align="center" style="padding-bottom:2px;">
                                                        <b> ADVERTISEMENT TYPE</b>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="right" style="padding-bottom:1px;">
                                                        L Band <input type="checkbox" style="width:30px ; height:30px; border: 1px solid #000; vertical-align: middle;" value="1" name="lband" <?php if($releasedata[0]->lband ==1) {echo 'checked';} ?>/>
                                                    </td>
                                                    <td align="right" style="padding-bottom:1px;">
                                                        Aston Band <input type="checkbox" style="width:30px ; height:30px; border: 1px solid #000; vertical-align: middle;" value="1" name="astonband" <?php if($releasedata[0]->astonband ==1) {echo 'checked';} ?>/>
                                                    </td>
                                                    <td align="right" style="padding-bottom:1px;">
                                                        Spot ROS <input type="checkbox" style="width:30px ; height:20px; border: 1px solid #000; vertical-align: middle;" value="1" name="spotros" <?php if($releasedata[0]->spotros ==1) {echo 'checked';} ?>/><br>
                                                        Spot RODP <input type="checkbox" style="width:30px ; height:20px; border: 1px solid #000; vertical-align: middle;" value="1" name="spotrodp" <?php if($releasedata[0]->spotrodp ==1) {echo 'checked';} ?>/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="right" style="padding-bottom:1px;">
                                                        Scroll <input type="checkbox" style="width:30px ; height:30px; border: 1px solid #000; vertical-align: middle;" value="1" name="scroll" <?php if($releasedata[0]->scroll ==1) {echo 'checked';} ?>/>
                                                    </td>
                                        <td align="right" style="padding-bottom:1px;">
                                            Slot <input type="checkbox" style="width:30px ; height:30px; border: 1px solid #000; vertical-align: middle;" value="1" name="slot" <?php if($releasedata[0]->slot ==1) {echo 'checked';} ?> />
                                                    </td>
                                            <td align="right" style="padding-bottom:1px;">
                                                Others <input type="checkbox" style="width:30px ; height:30px; border: 1px solid #000; vertical-align: middle;" value="1" name="others" <?php if($releasedata[0]->others ==1) {echo 'checked';} ?>/>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>

                                <table cellpadding="0" cellspacing="0" width="100%" border="0" style="border-left: 1px solid #000; border-bottom:1px solid #000; font-size: 11px;">
                                    <tr>
                                        <td style="padding: 5px; border-right: 1px solid #000; border-bottom: 1px solid #000; width: 150px;">
                                            ACTIVITY PERIOD</td>
                                        <td style="padding: 5px; border-right: 1px solid #000; border-bottom: 1px solid #000;">
                                            <div style="display:inline-block; "> FROM <input type="text" style="border:none;border-bottom: 1px solid #000; height:15px; width: 70px; " name="from" value="<?= $releasedata[0]->from;?>">
                                            </div>
                                            <div style="display:inline-block; "> TO <input type="text" style="border:none;border-bottom: 1px solid #000; height:15px; width: 70px; " name="to" value="<?= $releasedata[0]->to;?>">
                                            </div>
                                            <div style="display:inline-block; "> Total No. of Days <input type="text" style="border:none;border-bottom: 1px solid #000; height:15px; width: 70px; " name="tofdays" value="<?= $releasedata[0]->tofdays;?>">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 5px; border-right: 1px solid #000; border-bottom: 1px solid #000;"> TOTAL
                                            FCT</td>
                                        <td style="padding:0 5px; border-right: 1px solid #000; border-bottom: 1px solid #000;"><input type="text" style="border: none; width: 100%;" name="total" value="<?= $releasedata[0]->total;?>"/></td>

                                    </tr>
                                    <tr>
                                        <td style="padding: 5px; border-right: 1px solid #000; border-bottom: 1px solid #000;">AD
                                            INSERTION</td>
                                        <td style="padding:1px 10px; border-right: 1px solid #000; border-bottom: 1px solid #000;">
                                            <div style="display:inline-block; width: 30%;"> ROS <input type="checkbox" style="border: 1px solid #000; height:20px; width: 50px; vertical-align: middle;" name="ros" value="1" <?php if($releasedata[0]->ros ==1) {echo 'checked';} ?>> </div>
                                            <div style="display:inline-block; width: 30%;"> RODP <input type="checkbox" style="border: 1px solid #000; height:20px; width: 50px; vertical-align: middle;" name="rodp" value="1" <?php if($releasedata[0]->rodp ==1) {echo 'checked';} ?>> </div>
                                            <div style="display:inline-block; width: 30%;"> Prog. Specific <input type="checkbox" style="border: 1px solid #000; height:20px; width: 50px; vertical-align: middle;" name="prog" value="1" <?php if($releasedata[0]->prog ==1) {echo 'checked';} ?>></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 5px; border-right: 1px solid #000; ">RODP TIMINGS</td>
                                        <td style="padding:0 5px; border-right: 1px solid #000; "><input type="text" style="border: none; width: 100%;" name="rodptimings" value="<?= $releasedata[0]->rodptimings?>"/></td>
                                    </tr>
                                </table>



                                <table cellpadding="0" cellspacing="0" width="100%" border="0" style="">
                                    <tr>
                                        <td colspan="4" style="padding:5px 10px 0 10px ;"><b>ADVERTISEMENT MATERIAL :</b></td>
                                    </tr>
                                    <tr>
                                        <td style="padding:5px 10px ;">By Hand <input type="checkbox" style="border: 1px solid #000; height:20px; width: 30px; vertical-align: middle;" name="byhand" value="1" <?php if($releasedata[0]->byhand ==1) {echo 'checked';} ?>> </td>
                                        <td style="padding:5px 10px ;">By E-mail <input type="checkbox" style="border: 1px solid #000; height:20px; width: 30px; vertical-align: middle;" name="byemail" value="1" <?php if($releasedata[0]->byemail ==1) {echo 'checked';} ?>> </td>
                                        <td style="padding:5px 10px ;">Photo/E-brochures <input type="checkbox" style="border: 1px solid #000; height:20px; width: 30px; vertical-align: middle;" name="photoe" value="1" <?php if($releasedata[0]->photoe ==1) {echo 'checked';} ?>> </td>
                                        <td style="padding:5px 10px ;">As Enclosed <input type="checkbox" style="border: 1px solid #000; height:20px; width: 30px; vertical-align: middle;" name="asenclosed" value="1" <?php if($releasedata[0]->asenclosed ==1) {echo 'checked';} ?>> </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" style="padding:0px 10px 1px 10px;">Spot Ad Format:( Mov) 1920x1080 25 frames
                                            h.264 codac</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" style="padding:1px 10px ;"> Scroll Ad: NOT MORE THAN 40 words each scroll
                                            KANNADA OR ENGLISH</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" style="padding:1px 10px ;">Band Ads: Each frame for 10 Sec, max 3 bands</td>
                                    </tr>
                                </table>

                                <table cellpadding="0" cellspacing="0" width="100%" border="0" style="padding: 5px 10px 0 10px;">
                                    <tr>
                                        <td style="border-bottom:1px solid #000 ;">SPECIAL INSTRUCTIONS :</td>
                                    </tr>
                                    <tr>
                                        <td style="border-bottom:1px solid #000 ; padding: 0px 0;"><input type="text" style="border: none; width: 100%;" name="specialins" value="<?= $releasedata[0]->specialins?>"/> </td>
                                    </tr>
                                    <tr>
                                        <td style="border-bottom:1px solid #000 ; padding: 3px 0;">Value Added (only when applicable as
                                            per programme specific/event specific/festive specific proposals)</td>
                                    </tr>
                                    <tr>
                                        <td style="border-bottom:1px solid #000 ; padding: 0px 0;"> <input type="text" style="border: none; width: 100%;" name="valueadded" value="<?= $releasedata[0]->valueadded?>"/> </td>
                                    </tr>

                                </table>


                                <table cellpadding="0" cellspacing="0" width="100%" border="0" style="">
                                    <tr>
                                        <td style="width: 50%; padding:0 10px;">
                                            <table cellpadding="0" cellspacing="0" width="100%" border="0" style="font-size: 10px;">
                                                <tr>
                                                    <th colspan="2" align="left" style="border-bottom: 1px solid #000; font-size: 13px; padding:5px 10px ;">
                                                        TARIFF</th>
                                                </tr>
                                                <tr>
                                                    <td style="width:50%; border-bottom: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000; padding: 5px;">
                                                        BILL AMOUNT</td>
                                                    <td style="border-bottom: 1px solid #000; border-right: 1px solid #000; padding:0 5px;">
                                                        <input type="text" style="border: none; width: 100%;" name="billmount" value="<?= $releasedata[0]->billmount?>"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="border-bottom: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000; padding: 5px;">
                                                        GST</td>
                                                    <td style="border-bottom: 1px solid #000; border-right: 1px solid #000; padding:0 5px;">
                                                        <input type="text" style="border: none; width: 100%;" name="gst" value="<?= $releasedata[0]->gst?>"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="border-bottom: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000; padding: 5px;">
                                                        Deductions if any</td>
                                                    <td style="border-bottom: 1px solid #000; border-right: 1px solid #000; padding:0 5px;">
                                                        <input type="text" style="border: none; width: 100%;" name="deduction" value="<?= $releasedata[0]->deduction?>"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="border-bottom: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000; padding: 5px;">
                                                        TOTAL TO PAY</td>
                                                    <td style="border-bottom: 1px solid #000; border-right: 1px solid #000; padding:0 5px;">
                                                        <input type="text" style="border: none; width: 100%;" name="totalpay" value="<?= $releasedata[0]->totalpay?>"/>
                                                    </td>
                                                </tr>
                                            </table>

                                        </td>


                                        <td style="width: 50%; padding:0 10px;">
                                            <table cellpadding="0" cellspacing="0" width="100%" border="0" style="font-size: 10px;">
                                                <tr>
                                                    <th colspan="2" align="left" style="border-bottom: 1px solid #000; font-size: 13px; padding:5px 10px ;">
                                                        PAYMENT DETAILS</th>
                                                </tr>
                                                <tr>
                                                    <td style="width:50%; border-bottom: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000; padding: 5px;">
                                                        CHQ</td>
                                                    <td style="border-bottom: 1px solid #000; border-right: 1px solid #000; padding:0 5px;">
                                                        <input type="text" style="border: none; width: 100%;" name="chq" value="<?= $releasedata[0]->chq?>"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="border-bottom: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000; padding: 5px;">
                                                        CASH</td>
                                                    <td style="border-bottom: 1px solid #000; border-right: 1px solid #000; padding:0 5px;">
                                                        <input type="text" style="border: none; width: 100%;" name="cash" value="<?= $releasedata[0]->cash?>"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="border-bottom: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000; padding: 5px;">
                                                        NEFT</td>
                                                    <td style="border-bottom: 1px solid #000; border-right: 1px solid #000; padding:0 5px;">
                                                        <input type="text" style="border: none; width: 100%;" name="neft" value="<?= $releasedata[0]->neft?>"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="border-bottom: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000; padding: 5px;">
                                                        UPI</td>
                                                    <td style="border-bottom: 1px solid #000; border-right: 1px solid #000; padding:0 5px;">
                                                        <input type="text" style="border: none; width: 100%;" name="upi" value="<?= $releasedata[0]->upi?>"/>
                                                    </td>
                                                </tr>
                                            </table>

                                        </td>

                                    </tr>
                                </table>

                                <table cellpadding="0" cellspacing="0" width="100%" border="0" style="">
                                    <tr>
                                        <td style="padding: 5px 10px;">
                                            (Rupees <input type="text" style="width: 91%; border:none; border-bottom:1px dashed #000;" name="rupees" value="<?= $releasedata[0]->rupees?>"/> )
                                        </td>
                                    </tr>
                                </table>

                                <table cellpadding="0" cellspacing="0" width="100%" border="0" style="font-size: 11px;">
                                    <tr>
                                        <td style="width:50% ; padding: 0 10px;">
                                            <table cellpadding="0" cellspacing="0" width="100%" border="0" style="border: 1px solid #000; font-size: 10px;">
                                                <tr>
                                                    <th colspan="2" align="left" style="padding:5px 10px; font-size: 14px;">Payment in
                                                        favour of</th>
                                                </tr>
                                                <tr>
                                                    <td style="padding:2px 10px; width: 120px;">NAME</td>
                                                    <td style="padding:2px 10px;"><b>KAMADHENU TELEFILMS PRIVATE LIMITED</b></td>
                                                </tr>
                                                <tr>
                                                    <td style="padding:2px 10px;">BANK</td>
                                                    <td style="padding:2px 10px;"><b>INDIAN BANK RMV 2ND STAGE BRANCH, DEVASANDRA
                                                            BANGALORE</b></td>
                                                </tr>
                                                <tr>
                                                    <td style="padding:2px 10px;">BRANCH CODE</td>
                                                    <td style="padding:2px 10px;"><b>OORO50</b></td>
                                                </tr>
                                                <tr>
                                                    <td style="padding:2px 10px;">ACCOUNT NO.</td>
                                                    <td style="padding:2px 10px;"><b>0000000818854794</b></td>
                                                </tr>
                                                <tr>
                                                    <td style="padding:2px 10px;">IFSC CODE</td>
                                                    <td style="padding:2px 10px;"><b>IDIBOOORO50</b></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td style="width:50% ;" valign="top">
                                            <table cellpadding="0" cellspacing="0" width="100%" border="0" style="border: 1px solid #000; text-align: center;">
                                                <tr>
                                                    <th colspan="2" align="center" style="padding:5px 10px; font-size: 14px;">ACCEPTANCE
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <td style="padding:2px 10px;">
                                                        The above prices, specified & the below terms are satisfactory and are hereby
                                                        accepted by us
                                                    </td>
                                                </tr>

                                            </table>
                                        </td>
                                    </tr>
                                </table>


                                <table cellpadding="0" cellspacing="0" width="100%" border="0" style="font-size: 11px; margin:10px;">
                                    <tr>
                                        <td colspan="3">
                                            for<br>
                                            M/S Kamadhenu Telefilms Private Limited

                                        </td>

                                    </tr>
                                    <tr>
                                        <td align="center" style="padding:40px 0 0 0 ;">                               <div class="file-upload">
  <input class="file-upload__input" type="file" name="msign" id="myFile" multiple>
  <button class="file-upload__button" type="button">Upload Signature</button>
  <span class="file-upload__label"></span>
</div><br />(Client Manager)</td>

                                        <td align="center" style="padding:40px 0 0 0 ;">Authorised by</td>

                                        <td align="center" style="padding:40px 0 0 0 ;">                               <div class="file-upload">
  <input class="file-upload__input" type="file" name="csign" id="myFile" multiple>
  <button class="file-upload__button" type="button">Upload Signature</button>
  <span class="file-upload__label"></span>
</div><br />(Client's Signature with Seal)</td>
                                    </tr>
                                </table>

                                <table cellpadding="0" cellspacing="0" width="100%" border="0" style="font-size: 11px; margin:0 10px 15px 10px;">
                                    <tr>
                                        <th colspan="2" align="left" style="padding-bottom: 5px;">TERMS</th>
                                    </tr>
                                    <tr>

                                        <td>01.</td>
                                        <td>Release Order to be accompanied with 100% advance payment and Ad material as per the
                                            prescribed format.
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>02.</td>
                                        <td> No refund can be claimed for the advertisement telecasted with alleged material defect.</td>
                                    </tr>
                                    <tr>
                                        <td>03. </td>
                                        <td>Ads found suitable for telecast as per the norms set by the Channel, shall only be telecasted after
                                            preview, even though the payment has been made.</td>
                                    </tr>
                                    <tr>
                                        <td>04. </td>
                                        <td>The schedule shall commence within 48 working hours from the date and time of receipt of Release
                                            Order.</td>
                                    </tr>
                                    <tr>
                                        <td>05. </td>
                                        <td>Kamadhenu Telefilms Pvt Ltd, reserves the right to decline, change or re schedule any advertisement
                                            not withstanding the acceptance of the advertisement

                                            by our representative or even if the payment of the advertisement order is received by us. As the
                                            Channel's content for the day determines the Advertisement run. </td>
                                    </tr>
                                    <tr>
                                        <td> 06. </td>
                                        <td>All measures to relay as per the agreement will be made by Kamadhenu Telefilms Private Limited, but
                                            no guarantee can be given in this regard.</td>
                                    </tr>
                                    <tr>
                                        <td>07. </td>
                                        <td>Cancellation of any Orders to be informed through official communication prior to 48 working hours,
                                            you intent to cancel. Invoices will be made upto the date of this nofice period.</td>
                                    </tr>
                                    <tr>
                                        <td>08. </td>
                                        <td>Under no circumstances shall M/s Kamadhenu Telefilms Private Limited be liable for any loss to the
                                            advertiser or for any omission by us.</td>
                                    </tr>
                                    <tr>
                                        <td>09. </td>
                                        <td>Kamadhenu Telefilms Pvt. Ltd. does not undertake any responsibility for the content of the
                                            advertisement. 10. Terms may change from time to time. Tariff on important occasions. festive programs,
                                            Live telecasts will change.</td>
                                    </tr>
                                </table>


                            </td>
                        </tr>
                    </table>


                </div>
            </div>
        </div>
    </div>
 


 
</body>

</html>