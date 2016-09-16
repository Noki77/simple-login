/*
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
*/

var pwd1 = undefined;
var pwd2 = undefined;

var btn = undefined;

function checkPwd() {
    if (pwd1 === undefined) {
        pwd1 = document.getElementById("pwd1");
    }
    if (pwd2 === undefined) {
        pwd2 = document.getElementById("pwd2");
    }
    if (btn === undefined) {
        btn = document.getElementById("btn");
    }
    
    if (pwd1.value !== pwd2.value) {
        btn.disabled = true;
        pwd2.style.border = "1px #ff0000 solid";
    } else {
        btn.disabled = false;
        pwd2.style.border = "";
    }
}
