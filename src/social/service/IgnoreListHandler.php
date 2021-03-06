<?php
/**
 * Licensed to the Apache Software Foundation (ASF) under one
 * or more contributor license agreements.  See the NOTICE file
 * distributed with this work for additional information
 * regarding copyright ownership.  The ASF licenses this file
 * to you under the Apache License, Version 2.0 (the
 * "License"); you may not use this file except in compliance
 * with the License.  You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing,
 * software distributed under the License is distributed on an
 * "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
 * KIND, either express or implied.  See the License for the
 * specific language governing permissions and limitations
 * under the License.
 */

class IgnoreListHandler extends DataRequestHandler {

  protected static $IGNORELIST_PATH = "/ignorelist/{userId}/{groupId}/{ownerId}/{options}";

  protected static $ANONYMOUS_ID_TYPE = array('viewer', 'me');
  protected static $ANONYMOUS_VIEWER = array(
      'name' => 'anonymous_user',
      'displayName' => 'Guest'
  );

  public function __construct() {
    parent::__construct('ignorelist_service');
  }

  public function handleDelete(RequestItem $request) {
    throw new SocialSpiException("You can't delete ignorelist.", ResponseError::$BAD_REQUEST);
  }

  public function handlePut(RequestItem $request) {
    throw new SocialSpiException("You can't put ignorelist.", ResponseError::$BAD_REQUEST);
  }
 
  public function handlePost(RequestItem $request) {
    throw new SocialSpiException("You can't post ignorelist.", ResponseError::$BAD_REQUEST);
  }

  
  public function handleGet(RequestItem $request) {
    $this->checkService();
    $request->applyUrlTemplate(self::$IGNORELIST_PATH);

    $userIds = $request->getUsers();
    $groupId = $request->getGroup();
    $ownerId = $request->getParameter("ownerId");
    $token = $request->getToken();
    // Preconditions
    if (count($userIds) < 1) {
      throw new IllegalArgumentException("No userId specified");
    } 
    
    $service = $this->service;
    $ret = $service->getIgnoreList($userIds[0], $groupId, $ownerId[0], $token);
    return $ret;
  }

}
