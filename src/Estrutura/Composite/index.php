<?php

use App\Estrutura\Composite\Form;
use App\Estrutura\Composite\Input;
use App\Estrutura\Composite\Fieldset;
use App\Estrutura\Composite\FormElement;

require __DIR__.'/../../bootstrap.php';

/**
 * O código do cliente obtém uma interface conveniente para construir estruturas de árvore complexas.
 */
function getProductForm(): FormElement
{
    $form = new Form('product', "Add product", "/product/add");
    $form->add(new Input('name', "Name", 'text'));
    $form->add(new Input('description', "Description", 'text'));

    $picture = new Fieldset('photo', "Product photo");
    $picture->add(new Input('caption', "Caption", 'text'));
    $picture->add(new Input('image', "Image", 'file'));
    $form->add($picture);

    return $form;
}

/**
 * A estrutura do formulário pode ser preenchida com dados de várias fontes.
 * O cliente não precisa percorrer todos os campos do formulário para atribuir dados a vários campos desde o formulário
 * ela mesma pode lidar com isso.
 */
function loadProductData(FormElement $form)
{
    $data = [
        'name' => 'Apple MacBook',
        'description' => 'A decent laptop.',
        'photo' => [
            'caption' => 'Front photo.',
            'image' => 'photo1.png',
        ],
    ];

    $form->setData($data);
}

/**
 * O código do cliente pode funcionar com elementos de formulário usando a interface abstrata.
 * Desta forma, não importa se o cliente trabalha com um componente simples ou uma árvore composta complexa.
 */
function renderProduct(FormElement $form)
{
    echo $form->render();
}

$form = getProductForm();
loadProductData($form);
renderProduct($form);
