import requests
import json
from dotenv import load_dotenv
import os
load_dotenv()

url = os.getenv("TOKEN_API")
data =  {
    "email": os.getenv("EMAIL"),
    "password": os.getenv("PASSWORD")
  }
res = requests.post(url, json=data, verify=False)
tokenPass = res.text.split(":")[1].replace('}', '').strip().replace('"', "")
print(tokenPass)
print(type(tokenPass))
