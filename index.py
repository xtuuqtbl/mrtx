'''
Author: ForMemRs
Date: 2022-07-07 20:43:29
LastEditors: ForMemRs
LastEditTime: 2022-07-08 00:52:45
FilePath: /zaobao/index.py
Copyright (c) 2022 by ForMemRs, All Rights Reserved. 
'''
from config import TOKEN
from pushplus import pushplus
import requests
import re 


link_pattern = r'<a href="https://www.163.com/dy/article/(.*?)" class="'
news_pattern = r'<p id="10KNNM3D">(.*?)</p>'
url = 'https://www.163.com/dy/media/T1603594732083.html'
headers = {
    'User-Agent': 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36'
}

def get_daily_news():
    res = requests.get(url=url,headers=headers).text
    link_res = re.findall(link_pattern,res)
    today_link = 'https://www.163.com/dy/article/'+link_res[0]
    today_res = requests.get(url=today_link,headers=headers).text
    news = re.findall(news_pattern,today_res)
    res = pushplus(TOKEN,news[0])

def main_handler(*args):  # 腾讯云函数
    get_daily_news()

if __name__ =='__main__':
    get_daily_news()