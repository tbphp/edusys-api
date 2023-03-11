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
- `403` 没有权限。
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

### 学校列表

> `GET` /v1/teacher/schools (需要认证)

**Query:**

|    字段    | 类型  |      说明      |
|:--------:|:---:|:------------:|
|   page   | int |  页码。可选，默认1   |
| per_page | int | 每页行数。可选，默认15 |

> 注：此处是列表接口通用query参数，后文中的列表接口不再重复说明。

**返回：**

```json
{
  "code": 200,
  "msg": "success",
  "data": {
    "list": [
      {
        "id": 1,
        "name": "川大",
        "status": 2,
        "reject_reason": "",
        "created_at": 1678548854,
        "updated_at": 1678548856,
        "status_text": "正常",
        "is_owner": true
      }
    ],
    "total": 1,
    "current_page": 1,
    "last_page": 1,
    "per_page": 15,
    "from": 1,
    "to": 1
  }
}
```

|          字段          |   类型   |             说明              |
|:--------------------:|:------:|:---------------------------:|
|        total         |  int   |             总数量             |
|     current_page     |  int   |            当前页码             |
|      last_page       |  int   |            最后页数             |
|       per_page       |  int   |           每页显示数量            |
|         from         |  int   |           当前页开始id           |
|          to          |  int   |           当前页结束id           |
|         list         | array  |            数据列表             |
|      list.*.id       |  int   |            主键ID             |
|     list.*.name      | string |            学校编号             |
|    list.*.status     |  int   | 学校状态：<br/> 1.待审核 2.正常 3.已驳回 |
|  list.*.status_text  | string |          学校状态说明文字           |
| list.*.reject_reason | string |            驳回原因             |
|   list.*.is_owner    |  bool  |            是否管理员            |
|  list.*.created_at   |  int   |            创建时间             |
|  list.*.updated_at   |  int   |            更新时间             |

> 注：此处已经标注分页以及常用字段说明，后面分页以及常用字段不再重复说明。

### 创建学校

> `POST` /v1/teacher/schools (需要认证)

**入参：**

|  字段  |   类型   |       说明       |
|:----:|:------:|:--------------:|
| name | string | 学校名称。必填，4-50长度 |

### 学校详情

> `GET` /v1/teacher/schools/{school_id} (需要认证)

**返回：**

```json
{
  "code": 200,
  "msg": "success",
  "data": {
    "id": 1,
    "name": "川大",
    "status": 2,
    "reject_reason": "",
    "created_at": 1678548854,
    "updated_at": 1678548856,
    "status_text": "正常",
    "is_owner": true
  }
}
```

### 修改学校名称

> `PUT` /v1/teacher/schools/{school_id} (需要认证)
> 仅该学校管理员可操作

**入参：**

|  字段  |   类型   |       说明       |
|:----:|:------:|:--------------:|
| name | string | 学校名称。必填，4-50长度 |

### 擅长学校

> `DELETE` /v1/teacher/schools/{school_id} (需要认证)
> 仅该学校管理员可操作

## 学生
