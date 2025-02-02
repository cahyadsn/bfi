<?php
/*
================================================================================
 *  BISMILLAAHIRRAHMAANIRRAHIIM - In the Name of Allah, Most Gracious, Most Merciful
================================================================================
FILENAME      : assets/js/change.color.php
AUTHOR        : CAHYA DSN
CREATED DATE  : 2025-02-02 17:27:23
UPDATED DATE  : 2025-02-02 17:27:29
DEMO SITE     : https://psycho.cahyadsn.com/bfi
SOURCE CODE   : https://github.com/cahyadsn/bfi
================================================================================
This program is free software; you can redistribute it and/or modify it under the
terms of the MIT License.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

See the MIT License for more details

copyright (c) 2025 by cahya dsn; cahyadsn@gmail.com
================================================================================ */
if(isset($_POST)){
 session_start();
 $_SESSION['c']=$_POST['color'];
}