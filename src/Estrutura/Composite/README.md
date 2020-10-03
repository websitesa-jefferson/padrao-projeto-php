## PADRÃO COMPOSITE

##### Objetivo
permite que você componha objetos em estruturas de árvores e então trabalhe com essas estruturas como se elas fossem objetos individuais.

##### Contexto
Usar o padrão Composite faz sentido apenas quando o modelo central de sua aplicação pode ser representada como uma árvore.

##### Estrutura
- A interface Componente descreve operações que são comuns tanto para elementos simples como para elementos complexos da árvore.
- A Folha é um elemento básico de uma árvore que não tem sub-elementos.  
Geralmente, componentes folha acabam fazendo boa parte do verdadeiro trabalho, uma vez que não tem mais ninguém para delegá-lo.
- O Contêiner (ou composite) é o elemento que tem sub-elementos: folhas ou outros contêineres.  
Um contêiner não sabe a classe concreta de seus filhos. Ele trabalha com todos os sub-elementos apenas através da interface componente.  
Ao receber um pedido, um contêiner delega o trabalho para seus sub-elementos, processa os resultados intermediários, e então retorna o resultado final para o cliente.
- O Cliente trabalha com todos os elementos através da interface componente.  
Como resultado, o cliente pode trabalhar da mesma forma tanto com elementos simples como elementos complexos da árvore.

##### Aplicabilidade
- Utilize o padrão Composite quando você tem que implementar uma estrutura de objetos tipo árvore;
- Utilize o padrão quando você quer que o código cliente trate tanto os objetos simples como os compostos de forma uniforme.

~~~~
/**
 * A classe Component base declara uma interface para todos os componentes concretos, tanto simples quanto complexos.
 * Em nosso exemplo, vamos nos concentrar no comportamento de renderização de elementos DOM.
 */
abstract class FormElement
{
    /**
     * Podemos antecipar que todos os elementos DOM requerem esses 3 campos.
     */
    protected $name;
    protected $title;
    protected $data;

    public function __construct(string $name, string $title)
    {
        $this->name = $name;
        $this->title = $title;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setData($data): void
    {
        $this->data = $data;
    }

    public function getData(): array
    {
        return $this->data;
    }

    /**
     * Cada elemento DOM concreto deve fornecer sua implementação de renderização, mas podemos assumir com segurança
     * que todos os eles estão retornando strings.
     */
    abstract public function render(): string;
}

/**
 * Este é um componente Folha. Como todas as Folhas, não pode ter filhos.
 */
class Input extends FormElement
{
    private $type;

    public function __construct(string $name, string $title, string $type)
    {
        parent::__construct($name, $title);
        $this->type = $type;
    }

    /**
     * Since Leaf components don't have any children that may handle the bulk of the work for them, usually it
     * is the Leaves who do the most of the heavy-lifting within the Composite pattern.
     */
    public function render(): string
    {
        return "<label for=\"{$this->name}\">{$this->title}</label><br>" .
            "<input name=\"{$this->name}\" type=\"{$this->type}\" value=\"{$this->data}\"><br>";
    }
}

/**
 * A classe base Composite implementa a infraestrutura para gerenciar objetos filhos, reutilizada por todos os Concrete Composites.
 */
abstract class FieldComposite extends FormElement
{
    /**
     * @var FormElement[]
     */
    protected $fields = [];

    /**
     * Os métodos para adicionar / remover subobjetos.
     */
    public function add(FormElement $field): void
    {
        $name = $field->getName();
        $this->fields[$name] = $field;
    }

    public function remove(FormElement $component): void
    {
        $this->fields = array_filter($this->fields, function ($child) use ($component) {
            return $child != $component;
        });
    }

    /**
     * Enquanto o método da Folha apenas faz o trabalho, o método do Composite quase sempre tem que pegar seus subobjetos
     * em consideração.
     * Nesse caso, o composto pode aceitar dados estruturados.
     * @param array $ data
     */
    public function setData($data): void
    {
        foreach ($this->fields as $name => $field) {
            if (isset($data[$name])) {
                $field->setData($data[$name]);
            }
        }
    }

    /**
     * A mesma lógica se aplica ao getter. Ele retorna os dados estruturados do próprio composto (se houver) e todos
     * os dados dos filhos.
     */
    public function getData(): array
    {
        $data = [];

        foreach ($this->fields as $name => $field) {
            $data[$name] = $field->getData();
        }

        return $data;
    }

    /**
     * A implementação básica da renderização do Composite simplesmente combina os resultados de todos os filhos.
     * Concrete Composites será capaz de reutilizar esta implementação em suas implementações de renderização real.
     */
    public function render(): string
    {
        $output = "";

        foreach ($this->fields as $name => $field) {
            $output .= $field->render();
        }

        return $output;
    }
}

/**
 * O elemento fieldset é um composto concreto.
 */
class Fieldset extends FieldComposite
{
    public function render(): string
    {
        // Observe como o resultado da renderização combinada de filhos é incorporado à tag fieldset.
        $output = parent::render();

        return "<fieldset><legend>{$this->title}</legend><br>$output</fieldset><br>";
    }
}

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
~~~~
Fonte: https://refactoring.guru/pt-br/design-patterns/composite/php/example#example-1
