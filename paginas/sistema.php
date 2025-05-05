<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulação de Ônibus</title>
    <style>
        body { text-align: center; font-family: Arial, sans-serif; }
        .bus-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            background: #ccc;
            width: 300px;
            padding: 20px;
            border-radius: 15px;
            position: relative;
        }
        .lights {
            display: flex;
            justify-content: space-between;
            width: 100px;
            margin-bottom: 10px;
        }
        .light {
            width: 20px; height: 20px;
            background: red;
            border-radius: 50%;
        }
        .steering-wheel {
            width: 50px;
            height: 50px;
            background: black;
            border-radius: 50%;
            margin-bottom: 10px;
        }
        .seats-container {
            display: grid;
            grid-template-columns: repeat(6, 40px);
            gap: 5px;
        }
        .seat {
            width: 40px; height: 40px;
            background: green;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }
        .occupied { background: red; }
    </style>
</head>
<body>
    <h2>Simulação de Ônibus</h2>
    <div class="bus-container">
        <div class="lights">
            <div class="light"></div>
            <div class="light"></div>
        </div>
        <div class="steering-wheel"></div>
        <div class="seats-container">
            <div class="seat">1</div> 
            <div class="seat">2</div> 
            <div class="seat">3</div> 
            <div class="seat">4</div> 
            <div class="seat">5</div> 
            <div class="seat">6</div>
            <div class="seat">7</div>
             <div class="seat">8</div>
              <div class="seat">9</div>
               <div class="seat">10</div>
                <div class="seat">11</div> 
                <div class="seat">12</div>
            <div class="seat">13</div> <div class="seat">14</div> <div class="seat">15</div> <div class="seat">16</div> <div class="seat">17</div> <div class="seat">18</div>
            <div class="seat">19</div> <div class="seat">20</div> <div class="seat">21</div> <div class="seat">22</div> <div class="seat">23</div> <div class="seat">24</div>
            <div class="seat">25</div> <div class="seat">26</div> <div class="seat">27</div> <div class="seat">28</div> <div class="seat">29</div> <div class="seat">30</div>
            <div class="seat">31</div> <div class="seat">32</div> <div class="seat">33</div> <div class="seat">34</div> <div class="seat">35</div> <div class="seat">36</div>
            <div class="seat">37</div> <div class="seat">38</div> <div class="seat">39</div> <div class="seat">40</div> <div class="seat">41</div> <div class="seat">42</div>
            <div class="seat">43</div> <div class="seat">44</div> <div class="seat">45</div> <div class="seat">46</div> <div class="seat">47</div> <div class="seat">48</div>
        </div>
    </div>
</body>
</html>
