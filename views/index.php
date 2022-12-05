
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recite Me Test</title>

</head>
<body>
    <h1 style="width: 100%; text-align: center;">Welcome to my Recite Me test</h1>
    <p style="width: 100%; text-align: center;">Press the alt key and click on a cell to display the visit button</p>
    <form action="search" style="width: 100%; margin: auto; margin-bottom: 6px; padding: 6px 0px; text-align: center;">
        <input type="text" name="query" placeholder="Please input your search query" required>
        <button type="submit">Submit</button>
    </form>
    <?php
    $data = IndexController::getTableData();
    echo '<div class="card-holder" style="width: 100%; display: grid; grid-template-columns: repeat(5, 1fr); grid-auto-rows: 1fr; text-align: center; gap:25px;">';
    foreach ($data as $index => $d) {
        echo '<div class="card '.$index.'" style="margin-bottom: 4px; width:100%; border: solid black 2px;">'
        . '<p style="font-weight: bold;">' . $d['title'] . '</p>' .
        '<p>' . $d['author'] . '</p>' .
        '<a href="' . $d['url'] . '" target="_BLANK" class="button" style="display:none; text-decoration: none; font-weight: bold; color: black; padding: 10px 10px 5px 5px; background-color: aliceblue;">Visit</a>' .
        '</div>';
    }
    echo '</div>';

    ?>

    <script type="text/javascript">
        let elements = document.getElementsByClassName('card');
        let key = 0;
        var current;

        document.onkeydown = function(event) { 
            if(event.key == 'Alt') { 
                key = 1;
            }
        }
        document.onkeyup = function(event) { 
            if(event.key == 'Alt') { 
                key = 0;
            }
        }
        for(let i=0;i<elements.length;i++) { 
            elements[i].addEventListener('click',(event) => {
                
                if(key == 1 && current != i) { 
                    elements[i].querySelector('.button').style.display = "block";
                   if(current >= 0) { 
                    elements[current].querySelector('.button').style.display = "none";
                   }                    
                    current = i;
                }

                if(current != i) { 
                    elements[current].querySelector('.button').style.display = "none";
                    current = undefined; 
                }
            });
        }
        document.addEventListener("click", function(event) {
            if(event.path[0].className == 'card-holder') { 
                elements[current].querySelector('.button').style.display = "none"; 
                current = undefined;     
            }
        })
    </script>
</body>
</html>