<?php
	require_once "model/db_backup.php";
	$db = new db_backup;
	$data = $db->insert_database();
	if($data == "true") {
		$data = $db->db_import("database/deped_als.sql");
	}

?>
<html>
<style>
    body{
        margin: 0px;
        padding: 0px;
        text-align: center; 
        background-color: #777777;
        overflow: hidden;
        
    }
    #supermain{
        width: 100%;
        background-color: rebeccapurple;
        position: fixed;
        top: 40%;
        text-align: center;
    }
    #main{
        width: 500px;
        height: 60px; 
        font-size: 1.2em;
        position: fixed;
        left: 28%;
    }
    #main div{
        height: 20px;
        border-radius: 5px;
    }
    #black{
        width: 100%;
        background-color:white;
        box-shadow: 0px 1px 3px black;
    }
    #progress{
        width: 1%;
        background: linear-gradient(skyblue,deepskyblue);
        box-shadow: 0px 0px 12px lightblue;
    }
    .letter{
        font-family: borg9;
        font-size: 3.5em;
        transition-duration: 2s;
        transition-timing-function: ease-in-out;
        transform: translate(-300px,-300px) rotate(360deg) scale(0) skewX(80deg);
        animation-delay: 2s;
        animation-timing-function: ease-in-out;
    }
	@-webkit-keyframes glow {
		0%{
            text-shadow: 0px 0px 0px yellow;
            color:#8b8b8b;
        }
        50%{
            text-shadow: 3px 0px 10px red;
            color: #636363;
        }
        100%{
            text-shadow: 3px 0px 20px skyblue;
            color: black;
        }
	}
    @keyframes glow{
        0%{
            text-shadow: 0px 0px 0px yellow;
            color:#8b8b8b;
        }
        50%{
            text-shadow: 3px 0px 10px red;
            color: #636363;
        }
        100%{
            text-shadow: 3px 0px 20px skyblue;
            color: black;
        }
    }
    #kiddie{
        
        position: absolute;
        top:25%;
        width: 100%;
        transition: 1s;
        transform: translateY(-300px);
        
    }
</style>
<body>
	
    <div id="kiddie">
        <span class="letter child0">A</span>
        <span class="letter child1">l</span>
        <span class="letter child2">t</span>
        <span class="letter child3">e</span>
        <span class="letter child4">r</span>
        <span class="letter child5">n</span>
        <span class="letter child6">a</span>
        <span class="letter child7">t</span>
        <span class="letter child8">i</span>
        <span class="letter child9">v</span>
        <span class="letter child10">e </span>
        <span class="letter child11">L</span>
        <span class="letter child12">e</span>
        <span class="letter child13">a</span>
        <span class="letter child14">r</span>
		<span class="letter child15">n</span>
		<span class="letter child16">i</span>
		<span class="letter child17">n</span>
		<span class="letter child18">g </span>
		<span class="letter child19">S</span>
		<span class="letter child20">y</span>
		<span class="letter child21">s</span>
		<span class="letter child22">t</span>
		<span class="letter child23">e</span>
		<span class="letter child24">m</span>
    </div>
        
    <div id="supermain">
        <div id="main">
            <span id="sp">Please wait..</span>
            <div id="black" >
                <div id="progress"></div>
            </div>
        </div>
    </div>
  
</body>
    <script>
//when in the loading page the system remove the data in localstorage the name of the user who currently selected
      
        var prog=0;
        var go=false;
        var delay=0;
        var secret=0;
        function pro(){
//create a infinity loop
            window.requestAnimationFrame(pro); 
//check if the progress didt`n reach the maximun value of loading page
            if(prog<100){
                prog+=0.5;
                document.getElementById('progress').style.width=prog+"%";
            }
            else{
//when the progress bar reach in 100 the program will wait 1 second to go to homepage
                if(go==false){
                    sp.innerHTML="Done Loading.";
                    window.setTimeout(function k(){ 
                        window.location="login.php";
                    },1000);
                    go=true;
                }
            }
//create a delay effects in letter that glows one by 1
            delay+=2;
            if(delay>10&&secret<document.getElementsByClassName('letter').length){
                //document.getElementsByClassName('letter')[secret].style.transform="translate(0px,0px) rotate(0deg) scale(1) skewX(0deg)"; 
                document.getElementsByClassName('letter')[secret].style.WebkitAnimation ="glow 0.1s forwards 0.1s"; 
                document.getElementsByClassName('letter')[secret].style.animation = "glow 0.1s forwards 0.1s"; 
                secret++;
                delay=0;
            }  
            
        }
//this code show the game collection words
        kiddie.style.transform="translateY(0px)";
//check the window if fully loaded then call the function pro
        window.onload=pro();
    </script>
</html>