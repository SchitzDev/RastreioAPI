# API feita por mim, site usado para a base de informações: https://www.melhorrastreio.com.br/

<?php
header('Content-Type: application/json');

function testTrackingCode($code) {
    $url = "https://api.melhorrastreio.com.br/graphql";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'accept: */*',
        'accept-language: pt-PT,pt;q=0.6',
        'content-type: application/json',
        'origin: https://app.melhorrastreio.com.br',
        'sec-fetch-dest: empty',
        'sec-fetch-mode: cors',
        'sec-fetch-site: same-site',
        'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'
    ));

    $query = array(
        'query' => 'mutation searchParcel ($tracker: TrackerSearchInput!) {
            result: searchParcel (tracker: $tracker) {
                id
                createdAt
                updatedAt
                lastStatus
                lastSyncTracker
                nextSyncTracker
                pudos {
                    type
                    trackingCode
                }
                trackers {
                    type
                    shippingService
                    trackingCode
                }
                trackingEvents {
                    trackerType
                    trackingCode
                    createdAt
                    translatedEventId
                    description
                    title
                    to
                    from
                    location {
                        zipcode
                        address
                        locality
                        number
                        complement
                        city
                        state
                        country
                    }
                    additionalInfo
                }
            }
        }',
        'variables' => array(
            'tracker' => array(
                'trackingCode' => $code,
                'type' => 'correios'
            )
        )
    );

    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($query));
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode !== 200) {
        return array(
            'success' => false,
            'error' => 'Erro ao consultar API'
        );
    }

    $data = json_decode($response, true);
    
    if (!isset($data['data']['result'])) {
        return array(
            'success' => false,
            'error' => 'Código não encontrado'
        );
    }

    return array(
        'success' => true,
        'tracking' => $code,
        'http_code' => $httpCode,
        'data' => $data
    );
}

if(isset($_GET['code'])) {
    $code = strtoupper(trim($_GET['code']));
    $result = testTrackingCode($code);
    echo json_encode($result);
    exit;
}

echo json_encode([
    'success' => false,
    'error' => 'Código de rastreio não fornecido. Lembre se de usar o parâmetro code=$CodigoDeRastreio.'
]);
