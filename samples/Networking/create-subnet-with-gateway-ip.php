<?php
/**
 * Copyright 2012-2014 Rackspace US, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

//
// Pre-requisites:
// * Prior to running this script, you must setup the following environment variables:
//   * OS_AUTH_URL: Your OpenStack Cloud Authentication URL,
//   * OS_USERNAME: Your OpenStack Cloud Account Username,
//   * OS_PASSWORD: Your OpenStack Cloud Account Password,
//   * OS_REGION_NAME: The OpenStack Cloud region you want to use, and
//   * NETWORK_ID: ID of network in which to create subnet
//

require __DIR__ . '/../../vendor/autoload.php';
use OpenCloud\OpenStack;

// 1. Instantiate an OpenStack client.
$client = new OpenStack(getenv('OS_AUTH_URL'), array(
    'username' => getenv('OS_USERNAME'),
    'password' => getenv('OS_PASSWORD')
));

// 2. Obtain an Networking service object from the client.
$region = getenv('OS_REGION_NAME');
$networkingService = $client->networkingService(null, $region);

// 3. Create a subnet.
$subnet = $networkingService->createSubnet(array(
    'name' => 'My subnet',
    'networkId' => getenv('NETWORK_ID'),
    'ipVersion' => 4,
    'cidr' => '192.168.199.0/25',
    'gatewayIp' => '192.168.199.128'
));
/** @var $subnet OpenCloud\Networking\Resource\Subnet **/
