<!--
    This file is part of the project simple-login, licensed under the
    Creative Commons Attribution-NoDerivatives 4.0 International license.

    Copyright (c) 2016 Justin Vogel <dernoki77@gmail.com>
    Copyright (c) contributors

    You should have received a copy of the license along with this
    work. If not, see <http://creativecommons.org/licenses/by-nd/4.0/>.

    THIS SOFTWARE IS PROVIDED UNDER THE TERMS
    OF THIS CREATIVE COMMONS PUBLIC LICENSE ("CCPL" OR "LICENSE").
    THE SOFTWARE IS PROTECTED BY COPYRIGHT AND/OR OTHER APPLICABLE LAW.
    ANY USE OF THE WORK OTHER THAN AS AUTHORIZED UNDER THIS LICENSE
    OR COPYRIGHT LAW IS PROHIBITED.

    BY EXERCISING ANY RIGHTS TO THE SOFTWARE PROVIDED HERE,
    YOU ACCEPT AND AGREE TO BE BOUND BY THE TERMS OF THIS LICENSE.
    TO THE EXTENT THIS LICENSE MAY BE CONSIDERED TO BE A CONTRACT,
    THE LICENSOR GRANTS YOU THE RIGHTS CONTAINED HERE IN CONSIDERATION
    OF YOUR ACCEPTANCE OF SUCH TERMS AND CONDITIONS.
-->
<?php
include 'conf.inc.php';
session_start();
$globalDrawPanel = true;
function page($boxTitle, $panelType = "default", $drawPanel = true, $additionalHeaderCode = "") {
    global $globalDrawPanel;
    $globalDrawPanel = $drawPanel;

?>
    <html>
        <head>
            <title><?php echo $boxTitle; ?> - simple login</title>
            
            <meta charset="UTF-8">
            
            <?php
            Config::loadResource('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.4/css/bootstrap.min.css', false, true);
            Config::loadResource('simple-login.css');
            ?>
        </head>
        
        <body>
            <div id="page-wrapper">
                <div id="page-content">
                <?php if ($drawPanel) { ?>
                    <div class="card card-outline-<?php echo $panelType; ?>">
                        <div class="card-header bg-<?php echo $panelType; ?>">
                            <?php echo $additionalHeaderCode; ?>
                            <span class="card-title"><?php echo $boxTitle; ?></span>
                        </div>
                        <div class="card-block">
<?php }
}

function endPage() {
    global $globalDrawPanel;
                if ($globalDrawPanel) { ?>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </body>
    </html>
    <?php
}
