# bitbucket-to-dingtalk

bitbucket push代码、提交issue 提醒 到钉钉

 1. 把文件放到一个Php环境中，获取地址为:xxx.com/bitbucket.php
 2. 设置操作密码，如图所示：
![Alt text](./image/fd481e74-3cbd-48be-8af4-14fbb136fbf3.png)
3.在钉钉上面生成一个机器人接口，并复制access_token:
![Alt text](./image/f16a5512-39a9-4419-9622-29806a980bf6.png)
4.最后构造好url，如下：http://xxx.com/bitbucket.php?token=xxxx&pwd=xxxx
5.在bitbucket设置下Webhooks即可，如图所示：
![Alt text](./image/d2fd33b6-b0e5-45b5-bc74-d83690c612aa.png)
6.效果，如图所示：
![Alt text](./image/82a3387d-19df-4020-a6c6-2f46bb86e856.png)