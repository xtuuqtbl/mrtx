'''
Author: ForMemRs
Date: 2022-06-19 17:42:27
LastEditors: ForMemRs
LastEditTime: 2022-07-07 21:37:14
FilePath: /zaobao/pushplus.py
Copyright (c) 2022 by ForMemRs, All Rights Reserved. 
'''
import requests
import json

def pushplus(token,content,title='网易每日早报',template ='markdown'):
    url = 'http://www.pushplus.plus/send'
    data = {
        "token": token,
        "title": title,
        "content": content,
        "template":template
    }
    body = json.dumps(data).encode(encoding='utf-8')
    headers = {'Content-Type': 'application/json'}
    response = requests.post(url, data=body, headers=headers)
    if response.status_code ==200:
        return 1
    return 0

