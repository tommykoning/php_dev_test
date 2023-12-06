<html>
<head>
<script>

// A ajax call to get all the divisions of calcDivisor
function calcDivisorCall(num) {
  if (isNaN(+num)) {
      document.getElementById("divisors").innerHTML = "only numbers will be accepted ";
      return;
  } else {
      let xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          document.getElementById("divisors").innerHTML = this.responseText;
      }
      };
      xmlhttp.open("GET", "model/Calc.php?f=calcDivisor&q=" + num, true);
      xmlhttp.send();
  }
}

// A ajax call to get the fractorial of a user input 
function calcFactorialCall(num) {
  if (isNaN(+num)) {
      document.getElementById("factorial").innerHTML = "oonly numbers will be accepted";
      return;
  } else {
      let xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          document.getElementById("factorial").innerHTML = this.responseText;
      }
      };
      xmlhttp.open("GET", "model/Calc.php?f=calcFractorial&q=" + num, true);
      xmlhttp.send();
  }
}

// a array to keep a global copy of all prime numbers the user has put in
let primeNumberArray = []
function calcPrimeNumbersCall() {
  let xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
    document.getElementById("primeNumbers").innerHTML = 'XML file has been created';
  }
  };
  xmlhttp.open("GET", "model/Calc.php?f=calcPrimeNumbers&q=" + JSON.stringify(primeNumberArray), true);
  xmlhttp.send();
}

// quick and dirty function to add user inputs to the array and make some elements in the dom so its visual
function addPrimeNumberToArray() {
  const userInput = document.getElementById("primeInput").value
  const feedback = document.getElementById("primeNumberArrayMessage")

  if (!primeNumberArray.includes(userInput) && !isNaN(+userInput)) {
    primeNumberArray.push(userInput)

    let unorderedList = document.getElementById("PrimeNumberList");
    let listItem = document.createElement("li");
    let button = document.createElement("button");
    listItem.appendChild(document.createTextNode(userInput));
    listItem.setAttribute("id", "listItem" + userInput);
    button.setAttribute("onclick", "deleteItem(" + userInput + ")");
    button.appendChild(document.createTextNode('delete'))
    listItem.appendChild(button)
    unorderedList.appendChild(listItem);

  } else {
    feedback.innerHTML = 'this input already exists in the array or is not a number'
  }

  console.log(primeNumberArray)
}

// quick function to delete items out of the prime number array and the responding element from the dom
function deleteItem(number) {
  const indexNumber = primeNumberArray.indexOf(number)
  let listItem = document.getElementById("listItem"+number)

  listItem.remove()
  primeNumberArray.splice(indexNumber, 1)

  console.log(primeNumberArray)
}
</script>

</head>
<body>
  <p><b>CalcDivisor:</b></p>
  <p>CalcDivisor takes an integer and returns an array with all of the integer's divisors (except for 1and the number itself). Prime numbers are not allowed. </p>

  <label for="divisorInput">number you wish to know the divisions of :</label>
  <input type="text" id="divisorInput" name="divisorInput" onkeyup="calcDivisorCall(this.value)">

  <p>the number you put in can be devided by: <span id="divisors"></span></p>


  <p><b>CalcFactorial:</b></p>
  <p>CalcFactorial calculates and returns the factorial for a given input. Input below 0 and above 12 isnot allowed.</p>

    <label for="factorialInput">number you wish to know the fractorial of :</label>
    <input type="text" id="factorialInput" name="factorialInput" onkeyup="calcFactorialCall(this.value)">

  <p>fractorial of the input: <span id="factorial"></span></p>

  <p><b>CalcPrimeNumbers:</b></p>
  <p>
    CalcPrimeNumbers takes an array with integers finds the prime numbers and returns the result as a XML document which each found prime number in a ‘number’ node.
  </p>

  <label for="primeInput">Number you wish to add to the list of items :</label>
  <input type="text" id="primeInput" name="primeInput">
  <button type="button" onclick="addPrimeNumberToArray()">Add to list</button>
  <span id='primeNumberArrayMessage'></span>

  <ul id='PrimeNumberList'>
    <li>List of numbers</li>
  </ul>

  <button type="button" onclick='calcPrimeNumbersCall()'>Check primes</button>

  <p>The prime numbers in the list you submitted are: <span id="primeNumbers"></span></p>


</body>
</html>

<?php phpinfo();
