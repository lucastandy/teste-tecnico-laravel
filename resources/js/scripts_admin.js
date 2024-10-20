// Função para aplicar a máscara de moeda brasileira
function applyBrazilianMoneyMask() {
    // Selecionar todos os campos com a classe 'mask_price'
    let inputPrices = document.querySelectorAll('.mask_price');

    // Aplicar a máscara para cada campo encontrado
    inputPrices.forEach(function(inputPrice) {
        // Aguardar o usuário digitar valor no campo
        inputPrice.addEventListener('input', function () {
            // Obter o valor atual removendo qualquer caractere que não seja número
            let valuePrice = this.value.replace(/[^\d]/g, '');

            // Adicionar os separadores de milhares
            var formattedPrice = (valuePrice.slice(0, -2).replace(/\B(?=(\d{3})+(?!\d))/g, '.')) + '' + valuePrice.slice(-2);

            // Adicionar a vírgula e até dois dígitos se houver centavos
            if (formattedPrice.length > 2) {
                formattedPrice = formattedPrice.slice(0, -2) + "," + formattedPrice.slice(-2);
            }

            // Atualizar o valor do campo
            this.value = formattedPrice;
        });
    });
}

// Chamar a função quando o DOM estiver completamente carregado
document.addEventListener('DOMContentLoaded', applyBrazilianMoneyMask);

// Receber o seletor do campo CPF
let inputCpf = document.getElementById('cpf');

// Verificar se existe o seletor no HTML
if (inputCpf) {

    // Exemplo de uso: adicione o evento de entrada no campo
    document.getElementById('cpf').addEventListener('input', function () {
        aplicarMascaraCPF(this);
    });

}

// Máscara do CPF
function aplicarMascaraCPF(input) {
    let valor = input.value;

    // Remove todos os caracteres que não são números
    valor = valor.replace(/\D/g, '');

    // Limita a quantidade de caracteres a 11 (CPF tem 11 dígitos)
    if (valor.length > 11) {
        valor = valor.slice(0, 11);
    }

    // Aplica a máscara do CPF (###.###.###-##)
    valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
    valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
    valor = valor.replace(/(\d{3})(\d{1,2})$/, '$1-$2');

    // Define o valor do input com a máscara
    input.value = valor;
}

// Receber o seletor do campo Phone
let inputPhone = document.getElementById('phone');

// Verificar se existe o seletor no HTML
if (inputPhone) {

    // Exemplo de uso: adicione o evento de entrada no campo
    document.getElementById('phone').addEventListener('input', function () {
        aplicarMascaraCelular(this);
    });

}

// Máscara do Celular
function aplicarMascaraCelular(input) {
    let valor = input.value;

    // Remove todos os caracteres que não são números
    valor = valor.replace(/\D/g, '');

    // Limita a quantidade de caracteres a 11 (9 dígitos + DDD)
    if (valor.length > 11) {
        valor = valor.slice(0, 11);
    }

    // Aplica a máscara de celular (##) #####-####
    valor = valor.replace(/(\d{2})(\d)/, '($1) $2');
    valor = valor.replace(/(\d{5})(\d)/, '$1-$2');

    // Define o valor do input com a máscara
    input.value = valor;
}

// Receber o seletor do campo Code
let inputCode = document.getElementById('code');

// Verificar se existe o seletor no HTML
if (inputCode) {

    // Exemplo de uso: adicione o evento de perder foco no campo
    document.getElementById('code').addEventListener('blur', function () {
        transformarMaiusculo(this);
    });

}

// Função para transformar o campo em maiúsculo
function transformarMaiusculo(input) {
    input.value = input.value.toUpperCase();
}

// Receber o seletor do campo Imagem Nova
let inputImagemNova = document.getElementById('imagem_nova');


// Verificar se existe o seletor no HTML
if (inputImagemNova) {

    // Exemplo de uso: adicione o evento de entrada no campo
    document.getElementById('imagem_nova').addEventListener('input', function () {
        previewImagem()
    });

}

// Função para mostrar imagem do produto
function previewImagem() {
    var imagem = document.querySelector('input[name=imagem_nova').files[0];
    var preview = document.querySelector('#preview-product');

    var reader = new FileReader();
    reader.onloadend = function () {
        preview.src = reader.result;
    };
    if (imagem) {
        reader.readAsDataURL(imagem);
    } else {
        preview.src = "";
    }
}


// Receber o seletor do campo select produto do Iniciar venda
let selectProdutos = document.getElementById('produto_id');

// Verificar se existe o seletor no HTML
if (selectProdutos) {

    // Exemplo de uso: adicione o evento de entrada no campo
    document.getElementById('produto_id').addEventListener('change', function () {
        updateSalePrice()
    });

}

function updateSalePrice() {
    var select = document.getElementById('produto_id');
    var salePriceInput = document.getElementById('sale_price');
    if (salePriceInput) {
        var selectedOption = select.options[select.selectedIndex];
    
    // Obter o preço de venda e a quantidade disponível do produto selecionado
    var price = selectedOption.getAttribute('data-price');
    var availableQuantity = selectedOption.getAttribute('data-quantity');
    
    // Atualizar o campo de Preço de Venda
    salePriceInput.value = price;
    
    // Atualizar a quantidade máxima permitida
    document.getElementById('qtd_desejada').max = availableQuantity;
    
    // Limpar o total ao trocar o produto
    document.getElementById('total').value = '';

        
    }
    
}

// Receber o seletor do campo quantidade desejada
let qtd_desejada = document.getElementById('qtd_desejada');

// Verificar se existe o seletor no HTML
if (qtd_desejada) {

    // Exemplo de uso: adicione o evento de entrada no campo
    document.getElementById('qtd_desejada').addEventListener('change', function () {
        calculateTotal()
    });

}

function calculateTotal() {
    var quantityInput = document.getElementById('qtd_desejada');
    var salePriceInput = document.getElementById('sale_price');
    var totalInput = document.getElementById('total');
    var alertBox = document.getElementById('quantity_alert');
    
    var quantity = parseFloat(quantityInput.value);
    var price = parseFloat(salePriceInput.value);
    var availableQuantity = parseFloat(quantityInput.max);
    
    if (quantity > availableQuantity) {
        alertBox.style.display = 'block';  // Mostrar alerta se quantidade for maior
        totalInput.value = '';
    } else {
        alertBox.style.display = 'none';  // Ocultar alerta se quantidade for válida
        if (!isNaN(quantity) && !isNaN(price)) {
            totalInput.value = (quantity * price).toFixed(2).replace('.', ','); // Calcular e mostrar total
        }
    }
}


// Recebendo o seletor apagar e percorrendo a lista de registros
document.querySelectorAll('.btnDelete').forEach(function (button) {
    // Aguardando o clique do usuário no botão apagar
    button.addEventListener('click', function (event) {

        // Bloqueando o funcionamento padrão da página
        event.preventDefault();

        // Recebendo o atributo que possui o id do regitro que deve ser excluído
        var deleteId = this.getAttribute('data-delete-id');

        // SweetAlert
        Swal.fire({
            title: "Tem Certeza?",
            text: "Você não poderá reverter isso!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#dc3545",
            cancelButtonColor: "#0d6efd",
            cancelButtonText: 'Cancelar',
            confirmButtonText: "Sim, excluir"
        }).then((result) => {
            // Carregando a página responsável em excluir se o usuário confirmar a exclusão
            if (result.isConfirmed) {
                document.getElementById(`formDelete${deleteId}`).submit();   
            }
        });

    });
});

// Função para formatar o valor em Reais
function formatCurrency(value) {
    return new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(value);
}

// Função para calcular o desconto e atualizar o valor total
function calculateDiscount() {
    const totalVendaElement = document.querySelector('h2.mt-3.text-center');
    const totalVendaInput = document.getElementById('total_venda');
    const couponSelect = document.getElementById('coupon_id');
    const appliedCodeInput = document.getElementById('applied_code');
    const couponIdAppliedInput = document.getElementById('coupon_id_applied');


    // Verifica se todos os elementos necessários existem
    if (!totalVendaElement || !totalVendaInput || !couponSelect || !appliedCodeInput || !couponIdAppliedInput) {
        console.log("Elementos necessários não encontrados. Ignorando cálculo de desconto.");
        return;
    }

    // Obtém o valor original da venda do campo hidden
    const originalTotal = parseFloat(totalVendaInput.value);

    // Obtém o valor do desconto selecionado, o código do cupom e o ID do cupom
    const selectedOption = couponSelect.options[couponSelect.selectedIndex];
    const discountValue = selectedOption.value;
    const couponCode = selectedOption.text;
    const couponId = selectedOption.getAttribute('data-coupon_id');

    // Salva o código do cupom e o ID do cupom nos campos ocultos
    appliedCodeInput.value = couponCode;
    couponIdAppliedInput.value = couponId || '';

    // Se não houver cupom selecionado, restaura o valor original
    if (!discountValue) {
        totalVendaElement.textContent = `Valor Total da Compra: ${formatCurrency(originalTotal)}`;
        appliedCodeInput.value = ''; // Limpa o campo do código do cupom aplicado
        couponIdAppliedInput.value = ''; // Limpa o campo do ID do cupom aplicado
        return;
    }

    // Converte o valor do desconto para número
    const discountFactor = parseFloat(discountValue);

    // Calcula o valor do desconto
    const discountAmount = originalTotal * discountFactor;

    // Calcula o novo valor total
    const newTotal = originalTotal - discountAmount;

    // Atualiza o texto do valor total
    totalVendaElement.textContent = `Valor Total da Compra: ${formatCurrency(newTotal)}`;

    // Log para debug
    console.log('Cupom aplicado:', {
        code: couponCode,
        id: couponId,
        discount: discountValue
    });
}

// Função para inicializar o cálculo de desconto
function initDiscountCalculator() {
    


    const couponSelect = document.getElementById('coupon_id');
    if (couponSelect) {
        couponSelect.addEventListener('change', calculateDiscount);
        // Chama a função inicialmente para garantir que o valor esteja correto ao carregar a página
        calculateDiscount();
    } else {
        console.log("Elemento de seleção de cupom não encontrado. Funcionalidade de desconto não inicializada.");
    }
}

// Executa a inicialização quando o DOM estiver completamente carregado
document.addEventListener('DOMContentLoaded', initDiscountCalculator);





