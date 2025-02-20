# 📦 API de Rastreamento de Encomendas

Esta é uma API robusta e eficiente para consultar o status de encomendas em tempo real utilizando o serviço do [Melhor Rastreio](https://www.melhorrastreio.com.br). Desenvolvida com PHP e GraphQL, oferece uma interface simples e rápida para rastreamento de objetos postais.

---

## 🎯 Objetivo

Fornecer uma solução confiável e de fácil integração para rastreamento de encomendas dos Correios, permitindo que sistemas externos possam consultar informações detalhadas sobre o status de entregas.

## 🌟 Funcionalidades

- Rastreamento em tempo real de encomendas dos Correios
- Respostas formatadas em JSON para fácil integração
- Suporte a múltiplos eventos de rastreamento
- Informações detalhadas sobre localização e status

---

## 🔧 Como Implementar

### Endpoint Base
```
GET http://127.0.0.1/api.php
```

### Parâmetros da Requisição

| Parâmetro | Tipo   | Obrigatório | Descrição                                                    |
|-----------|--------|-------------|--------------------------------------------------------------|
| `code`    | String | Sim         | Código de rastreio dos Correios (ex.: `TJ305940003BR`)      |

### Headers Recomendados
```
Content-Type: application/json
Accept: application/json
```

---

## 📝 Exemplos de Uso

### Exemplo de Requisição
```bash
curl -X GET "http://127.0.0.1/api.php?code=TJ305940003BR" \
     -H "Accept: application/json"
```

### Resposta de Sucesso
```json
{
  "success": true,
  "tracking": "TJ305940003BR",
  "http_code": 200,
  "data": {
    "data": {
      "result": {
        "id": "67adef7e849bbe99212ee003",
        "createdAt": "2025-02-13T10:11:26.094Z",
        "updatedAt": "2025-02-19T23:04:48.184Z",
        "lastStatus": "DELIVERED",
        "lastSyncTracker": "2025-02-19T23:04:48.184Z",
        "nextSyncTracker": "2025-02-20T01:03:48.183Z",
        "pudos": [],
        "trackers": [
          {
            "type": "correios",
            "shippingService": "unknown",
            "trackingCode": "TJ305940003BR"
          }
        ],
        "trackingEvents": [
          {
            "trackerType": "correios",
            "trackingCode": "TJ305940003BR",
            "createdAt": "2025-02-13T08:29:43.000Z",
            "translatedEventId": 5,
            "description": null,
            "title": "Objeto em transferência - por favor aguarde",
            "to": "Unidade de Distribuição - SALVADOR/BA",
            "from": "Unidade de Tratamento - SALVADOR/BA",
            "location": {
              "zipcode": null,
              "address": null,
              "locality": null,
              "number": null,
              "complement": "Unidade de Tratamento",
              "city": "SALVADOR",
              "state": "BA",
              "country": null
            },
            "additionalInfo": null
          }
        ]
      }
    }
  }
}
```

Resposta de Erro

```json
{
  "success": false,
  "error": "Código de rastreio incorreto ou não fornecido."
}
```


## 🚀 Stack Tecnológica

- **Backend:** PHP 7.4+
- **Requisições:** cURL
- **API Externa:** GraphQL (MelhorRastreio)
- **Formato de Dados:** JSON
- **Documentação:** Markdown

## 📌 Observações Importantes

- Todas as requisições são feitas em tempo real ao MelhorRastreio
- Suporte atual apenas para encomendas dos Correios


## 👨‍💻 Autor

**Bruno Schitz**
- GitHub: [@SchitzDev](https://github.com/SchitzDev)

## 📄 Licença

Este projeto está sob a licença MIT. 

---
