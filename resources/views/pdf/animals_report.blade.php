<!DOCTYPE html><!--  This site was created in Webflow. http://www.webflow.com  -->
<!--  Last Published: Mon Nov 02 2020 09:08:50 GMT+0000 (Coordinated Universal Time)  -->
<html data-wf-page="5ea837e8c81001b668dffd4a" data-wf-site="5ea837e8c8100167b2dffd49">
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body class="body">
<div class="columns w-row">
    <div class="leftcontent w-col w-col-6 w-col-stack">
        <img   src="{{ storage_path('app/public/img.jpg') }}" style="width: 200px; height: 100px">
    </div>
    <div class="rightcontent w-col w-col-6 w-col-stack">
        <div data-w-id="3fd5aeb3-22da-ed60-7286-0d11f16597d3" style="opacity:0" class="content">
            <div class="name">Folio: 0000{{$Animal->getId()}}</div>
            <h1 class="tagline"><strong class="bold-text">{{$Animal->getNombre()}}</strong></h1>
            <div class="links w-row">
                <div class="column w-col w-col-4">
                    <div class="text-block-2">Datos adicionales</div>
                    <ul role="list" class="list w-list-unstyled">
                        <li>
                            <p>Especie: {{$Animal->getEspecie()}}</p>
                        </li>

                        <li>
                            <p>Fecha y hora de creación: {{$Animal->getCreatedAt()}}</p>
                        </li>

                    </ul>

                </div>


            </div>
            <div class="credit"> <strong>Zoológico Payo Obispo </strong></div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
