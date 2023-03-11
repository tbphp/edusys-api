# 接口文档

接口请求入参和返回数据都使用`JSON`格式，并且返回为固定格式：

```json
{
  "code": 200,
  "message": "success",
  "data": {
    "key1": "value1",
    "key2": "value2"
  }
}
```

|   字段    |   类型   |        说明        |
|:-------:|:------:|:----------------:|
|  code   |  int   | 返回码，见[返回码](#返回码) |
| message | string |  返回信息，用于详细的错误描述  |
|  data   | object |       返回数据       |

## 返回码

- `401` 用户认证失败，登录错误或者token失效。
- `404` 路由错误，接口不存在。
- `410` 数据不存在。
- `422` 字段验证失败。
- `510` 业务异常，具体查看返回`message`。

## 公共

### 登录

> `POST` /v1/login (不需要认证)

**入参：**

|    字段    |   类型   |                  说明                   |
|:--------:|:------:|:-------------------------------------:|
| identity |  int   |            身份：1.教师，2.学生。必填            |
| username | string | 用户名。<br/>必填，如果是教师则必须为邮箱格式，如果是学生则不少于4位 |
| password | string |                 密码。必填                 |

**返回：**

```json
{
  "code": 200,
  "msg": "success",
  "data": {
    "token_type": "bearer",
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjlmNmJlZTM4ZDM4NDFjZWYwMGRlZjRmOTU3ZGQ2N2UxZDMxZmNhODAyYmYzZTk5ZTI0YWI0N2Q4YWUzMjVjNzQxYmI1Yzc1Mzk3YWFiNzIwIn0.eyJhdWQiOiIxIiwianRpIjoiOWY2YmVlMzhkMzg0MWNlZjAwZGVmNGY5NTdkZDY3ZTFkMzFmY2E4MDJiZjNlOTllMjRhYjQ3ZDhhZTMyNWM3NDFiYjVjNzUzOTdhYWI3MjAiLCJpYXQiOjE2Nzg1MDQ0MTEsIm5iZiI6MTY3ODUwNDQxMSwiZXhwIjoxNzEwMTI2ODExLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.se9sbNaHcxEZaklZzwHrRRnbNn1mf7o1z8aTI0K83FgjEw62Q2iv9KsCmF3KP6TygvKExVrYOk-hPjHQmwVEJNC9u_aATIJyKZqztj6_ktl5P-T8OXdtJUCzPRi9brDuKHym5eAsI10rzJ2JLpBYfdkN6zVsclRXhEB5z9uBCxPW3NwhtRtjHEx469drcVO4DDcGJkNl2y8psojn2cxMwZcPqwrTv4czvs9g0ePEyxyZ0CqH9rlNwpUB1hn5TJJ6l9tJKlAThGBnPMCepMl5rlAUpZaudNJHILyydfd0EZopRpgtLTF5tafA0i_yftnZa3JfwVzRKHlrgfj_ZGi3-VK2Cpn-NyH1WPtAHHH4Lhb9z-_6bDGF340bKfF34An3sgAI8ABB9e4av2Ic5uZHyeIdfbcF0ro2_7kPljVDHXw77nTYtSYziTq4hSkg34pty3Tx5E_ZWUwmb6NakyOI1LP33_bAhq5OX_t_GUnGWsHtQHKt_Z3FiFcsz0dmyzzdtqcX6ivvItAnnpIBJcBWH1MIFrwgPxW5xPemMfAUzYZVZrm6jk-MzHmI6cOwHCDYy7QBuczSsx4FHiF944HJqDLBS5c4B3S_pljhcBGZetuh7JmqU4rciNqpH9CC2rzm48rVP_AtZ0MsHcIhbHkLQIGlv0_wpsso9EMaV-AEr7s"
  }
}
```

|      字段      |   类型   |        说明         |
|:------------:|:------:|:-----------------:|
|  token_type  | string | 令牌类型，固定字符串，bearer |
| access_token | string |      用户访问令牌       |

## 教师

### 注册

> `POST` /v1/teacher/register (不需要认证)

**入参：**

|    字段    |   类型   |     说明      |
|:--------:|:------:|:-----------:|
|   name   | string |    名称。必填    |
| username | string | 用户名。必填，邮箱格式 |
| password | string | 密码。必填，6-32位 |

**返回：**

```json
{
  "code": 200,
  "msg": "success",
  "data": {
    "token_type": "bearer",
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjlmNmJlZTM4ZDM4NDFjZWYwMGRlZjRmOTU3ZGQ2N2UxZDMxZmNhODAyYmYzZTk5ZTI0YWI0N2Q4YWUzMjVjNzQxYmI1Yzc1Mzk3YWFiNzIwIn0.eyJhdWQiOiIxIiwianRpIjoiOWY2YmVlMzhkMzg0MWNlZjAwZGVmNGY5NTdkZDY3ZTFkMzFmY2E4MDJiZjNlOTllMjRhYjQ3ZDhhZTMyNWM3NDFiYjVjNzUzOTdhYWI3MjAiLCJpYXQiOjE2Nzg1MDQ0MTEsIm5iZiI6MTY3ODUwNDQxMSwiZXhwIjoxNzEwMTI2ODExLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.se9sbNaHcxEZaklZzwHrRRnbNn1mf7o1z8aTI0K83FgjEw62Q2iv9KsCmF3KP6TygvKExVrYOk-hPjHQmwVEJNC9u_aATIJyKZqztj6_ktl5P-T8OXdtJUCzPRi9brDuKHym5eAsI10rzJ2JLpBYfdkN6zVsclRXhEB5z9uBCxPW3NwhtRtjHEx469drcVO4DDcGJkNl2y8psojn2cxMwZcPqwrTv4czvs9g0ePEyxyZ0CqH9rlNwpUB1hn5TJJ6l9tJKlAThGBnPMCepMl5rlAUpZaudNJHILyydfd0EZopRpgtLTF5tafA0i_yftnZa3JfwVzRKHlrgfj_ZGi3-VK2Cpn-NyH1WPtAHHH4Lhb9z-_6bDGF340bKfF34An3sgAI8ABB9e4av2Ic5uZHyeIdfbcF0ro2_7kPljVDHXw77nTYtSYziTq4hSkg34pty3Tx5E_ZWUwmb6NakyOI1LP33_bAhq5OX_t_GUnGWsHtQHKt_Z3FiFcsz0dmyzzdtqcX6ivvItAnnpIBJcBWH1MIFrwgPxW5xPemMfAUzYZVZrm6jk-MzHmI6cOwHCDYy7QBuczSsx4FHiF944HJqDLBS5c4B3S_pljhcBGZetuh7JmqU4rciNqpH9CC2rzm48rVP_AtZ0MsHcIhbHkLQIGlv0_wpsso9EMaV-AEr7s"
  }
}
```

|      字段      |   类型   |        说明         |
|:------------:|:------:|:-----------------:|
|  token_type  | string | 令牌类型，固定字符串，bearer |
| access_token | string |      用户访问令牌       |

## 学生
