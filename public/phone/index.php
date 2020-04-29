<?php
$phone="";
if(isset($_GET['telephone'])) $phone=trim($_GET['telephone']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>ctxSip</title>
    <link rel="icon" type="image/gif" href="img/favicon.ico" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <link href="css/ctxSip.css" rel="stylesheet" type="text/css" />
</head>
<body id="sipClient">
<div class="container-fluid">

    <div class="clearfix sipStatus">
        <div id="txtCallStatus" class="pull-right">&nbsp;</div>
        <div id="txtRegStatus"></div>
    </div>

    <div class="form-group" id="phoneUI">
        <div class="input-group">
            <div class="input-group-btn">
                <button class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" title="Show Keypad">
                    <i class="fa fa-th"></i>
                </button>
                <div id="sip-dialpad" class="dropdown-menu">
                    <button type="button" class="btn btn-default digit" data-digit="1">1<span>&nbsp;</span></button>
                    <button type="button" class="btn btn-default digit" data-digit="2">2<span>ABC</span></button>
                    <button type="button" class="btn btn-default digit" data-digit="3">3<span>DEF</span></button>
                    <button type="button" class="btn btn-default digit" data-digit="4">4<span>GHI</span></button>
                    <button type="button" class="btn btn-default digit" data-digit="5">5<span>JKL</span></button>
                    <button type="button" class="btn btn-default digit" data-digit="6">6<span>MNO</span></button>
                    <button type="button" class="btn btn-default digit" data-digit="7">7<span>PQRS</span></button>
                    <button type="button" class="btn btn-default digit" data-digit="8">8<span>TUV</span></button>
                    <button type="button" class="btn btn-default digit" data-digit="9">9<span>WXYZ</span></button>
                    <button type="button" class="btn btn-default digit" data-digit="*">*<span>&nbsp;</span></button>
                    <button type="button" class="btn btn-default digit" data-digit="0">0<span>+</span></button>
                    <button type="button" class="btn btn-default digit" data-digit="#">#<span>&nbsp;</span></button>
                    <div class="clearfix">&nbsp;</div>
                    <button class="btn btn-success btn-block btnCall" title="Send">
                        <i class="fa fa-play"></i> Send
                    </button>
                </div>
            </div>
            <input type="text" name="number" id="numDisplay" class="form-control text-center input-sm" value="<?=$phone?>" placeholder="Numara giriniz..." autocomplete="off" />
            <div class="input-group-btn input-group-btn-sm">
                <button class="btn btn-sm btn-primary dropdown-toggle" id="btnVol" data-toggle="dropdown" title="Volume">
                    <i class="fa fa-fw fa-volume-up"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <input type="range" min="0" max="100" value="100" step="1" id="sldVolume" />
                </div>
            </div>
        </div>
    </div>

    <div class="well-sip">
        <div id="sip-splash" class="text-muted text-center panel panel-default">
            <div class="panel-body">
                <h3 class="page-header">
                <span class="fa-stack fa-2x">
                    <i class="fa fa-circle fa-stack-2x text-success"></i>
                    <i class="fa fa-phone fa-stack-1x fa-inverse"></i>
                </span><br>
                This is your phone.</h3>
                <p class="lead">To make a call enter a number or SIP address in the box above.</p>
                <small>Closing this window will cause calls to go to voicemail.</small>
            </div>
        </div>

        <div id="sip-log" class="panel panel-default hide">
            <div class="panel-heading">
                <h4 class="text-muted panel-title">Recent Calls <span class="pull-right"><i class="fa fa-trash text-muted sipLogClear" title="Clear Log"></i></span></h4>
            </div>
            <div id="sip-logitems" class="list-group">
                <p class="text-muted text-center">No recent calls from this browser.</p>
            </div>
        </div>
    </div>

    <div class="modal fade" id="mdlError" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Sip Error</h4>
                </div>
                <div class="modal-body text-center text-danger">
                    <h3><i class="fa fa-3x fa-ban"></i></h3>
                    <p class="lead">Sip registration failed. No calls can be handled.</p>
                </div>
            </div>
        </div>
    </div>

</div>

<audio id="ringtone" src="sounds/incoming.mp3" loop></audio>
<audio id="ringbacktone" src="sounds/outgoing.mp3" loop></audio>
<audio id="dtmfTone" src="sounds/dtmf.mp3"></audio>
<audio id="audioRemote"></audio>

<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript" src="scripts/moment.js/moment.min.js"></script>

<script type="text/javascript" src="scripts/SIP.js/sip.min.js"></script>
<script type="text/javascript" src="scripts/config.js?v=6"></script>
<script type="text/javascript" src="scripts/app.js?v=7"></script>

</body>
</html>
