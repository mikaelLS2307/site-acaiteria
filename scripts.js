const addressForm = document.querySelector("#address-form");
const cepInput = document.querySelector("#cep");
const addressInput = document.querySelector("#address");
const cityInput = document.querySelector("#city");
const neighborhoodInput = document.querySelector("#neighborhood");
const regionInput = document.querySelector("#region");
const formInputs = document.querySelectorAll("[data-input]");

const closeButton = document.querySelector("#close-message");

// Validar entrada do CEP
cepInput.addEventListener("keypress", (e) => {
  const onlyNumbers = /[0-9]|\./;
  const key = String.fromCharCode(e.keyCode);

  console.log(key);

  console.log(onlyNumbers.test(key));

  // permitir apenas números
  if (!onlyNumbers.test(key)) {
    e.preventDefault();
    return;
  }
});

// obter endereço
cepInput.addEventListener("keyup", (e) => {
  const inputValue = e.target.value;

  //  Verifique se temos um CEP
  if (inputValue.length === 8) {
    getAddress(inputValue);
  }
});

//Obter endereço da API
const getAddress = async (cep) => {
  toggleLoader();

  cepInput.blur();

  const apiUrl = `https://viacep.com.br/ws/${cep}/json/`;

  const response = await fetch(apiUrl);

  const data = await response.json();

  console.log(data);
  console.log(formInputs);
  console.log(data.erro);

  

  // Ative o atributo desativado se o formulário estiver vazio
  if (addressInput.value === "") {
    toggleDisabled();
  }

  addressInput.value = data.logradouro;
  cityInput.value = data.localidade;
  neighborhoodInput.value = data.bairro;
  regionInput.value = data.uf;

  toggleLoader();
};

// Adicionar ou remover atributo desabilitado
const toggleDisabled = () => {
  if (regionInput.hasAttribute("cep")) {
    formInputs.forEach((input) => {
      input.removeAttribute("enabled");
    });
  } else {
    formInputs.forEach((input) => {
      input.setAttribute("enabled", "enabled");
    });
  }
};

// Mostrar ou ocultar carregador
const toggleLoader = () => {
  const fadeElement = document.querySelector("#fade");
  const loaderElement = document.querySelector("#loader");

  fadeElement.classList.toggle("hide");
  loaderElement.classList.toggle("hide");
};



function mostrarMensagem() {
  var toastEl = document.getElementById('pedidoRealizadoToast');
  toastEl.style.display = 'block';
  setTimeout(function(){
  toastEl.style.display = 'none';
}, 2000); // Esconde a mensagem após 3 segundos
}

function redirecionarParaTelaInicial() {
  var messageDiv = document.getElementById('pedidoRealizadoToast');
  var spinnerDiv = document.getElementById('loadingScreen');
  
  messageDiv.style.display = 'flex'; // Mostrar a mensagem
  setTimeout(function() {
      messageDiv.style.display = 'none'; // Ocultar a mensagem
      spinnerDiv.style.display = 'flex'; // Mostrar o spinner
      setTimeout(function() {
          window.location.href = 'index.html'; // Altere para a URL da sua tela inicial
      }, 1000);
  }, 2000); // Tempo de exibição da mensagem antes do spinner

  
}
    