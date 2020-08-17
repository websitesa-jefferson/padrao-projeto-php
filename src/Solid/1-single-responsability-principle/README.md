## 1 - SINGLE RESPONSABILITY PRINCIPLE (PRINCÍPIO DE RESPONSABILIDADE ÚNICA)

O primeiro princípio diz que uma classe deve ter exclusivamente uma responsabilidade.

Diz que quando temos uma classe que não atenda esse princípio, devemos dividi-la em mais classes até que isso ocorra.

##### Ferindo o princípio da responsabilidade única
Criaremos uma classe para gerenciar relatórios.
~~~~
<?php

class Report
{
    public function getTitle()
    {
        return 'Report Title';
    }

    public function getDate()
    {
        return '2018-01-22';
    }

    public function getContents()
    {
        return [
            'title' => $this->getTitle(),
            'date' => $this->getDate(),
        ];
    }

    public function formatJson()
    {
        return json_encode($this->getContents());
    }
}
~~~~
Nesse exemplo, a classe tem duas responsabilidades:

- Trazer os dados do relatório.
- Formatar o relatório para JSON.

##### Aplicando o princípio da responsabilidade única
~~~~
<?php

class Report
{
    public function getTitle()
    {
        return 'Report Title';
    }

    public function getDate()
    {
        return '2018-01-22';
    }

    public function getContents()
    {
        return [
            'title' => $this->getTitle(),
            'date' => $this->getDate(),
        ];
    }
}

class JsonReportFormatter
{
    public function format(Report $report)
    {
        return json_encode($report->getContents());
    }
}
~~~~
Agora foi criado uma nova classe chamada JsonReportFormatter, responsável exclusivamente em formatar o relatório em JSON.
