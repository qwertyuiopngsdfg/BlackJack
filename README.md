# BlackJack

#ルール
2人対戦（CPUとプレイヤー）  
ジョーカーを含まない52枚のトランプのカードで得点を競う  
絵札(J,Q,K)は10点として扱う。  
Aは合計得点が21点以上にならないように、かつ合計得点が21点に近くなるように、１点か１１点として扱う。  
最初にプレイヤーとCPUは2枚ずつドローする。CPUの2枚目にドローしたカードは非表示。  
ユーザーの合計得点が21点になった場合ブラックジャックとなり、CPUの得点に関係なく勝利となる。  
21点を超えてしまった場合はバーストとなり、その時点でバーストした側の負けとなる。  
先にユーザーが任意の枚数ドロー  
その後、CPUは17点以上になるようにドロー、より21点に近いほうの勝利。  
同点の場合は引き分け。