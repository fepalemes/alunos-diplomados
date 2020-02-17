/* 
  Contents : JS CPF E CNPJ
*/

function jsPCPFCNPJ( campo ) {
  var v = campo.value;
  var z = "1234567890";
  var a = v.length;
  var r = "";
  var c = "";
  for (i=0; i<a; i++) {
    c = v.substr(i,1);
    if (z.indexOf(c) < 0) { } else { r = r + c; }
  }
  v = r;
  a = v.length;
  if (a == 0) { campo.value = v; }
  if (a == 1) { campo.value = v; }
  if (a == 2) { campo.value = v; }
  if (a == 3) { campo.value = v; }
  if (a == 4) { campo.value = v.substr(0,3) +"."+ v.substr(3,1); }
  if (a == 5) { campo.value = v.substr(0,3) +"."+ v.substr(3,2); }
  if (a == 6) { campo.value = v.substr(0,3) +"."+ v.substr(3,3); }
  if (a == 7) { campo.value = v.substr(0,3) +"."+ v.substr(3,3)+"."+ v.substr(6,1); }
  if (a == 8) { campo.value = v.substr(0,3) +"."+ v.substr(3,3)+"."+ v.substr(6,2); }
  if (a == 9) { campo.value = v.substr(0,3) +"."+ v.substr(3,3)+"."+ v.substr(6,3); }
  if (a == 10) { campo.value = v.substr(0,3) +"."+ v.substr(3,3)+"."+ v.substr(6,3)+"-"+ v.substr(9,1); }
  if (a == 11) { campo.value = v.substr(0,3) +"."+ v.substr(3,3)+"."+ v.substr(6,3)+"-"+ v.substr(9,2); }
  if (a == 12) { campo.value = v.substr(0,2) +"."+ v.substr(2,3) +"."+ v.substr(5,3) +"/"+ v.substr(8,4); }
  if (a == 13) { campo.value = v.substr(0,2) +"."+ v.substr(2,3) +"."+ v.substr(5,3) +"/"+ v.substr(8,4) +"-"+ v.substr(12,1); }
  if (a >= 14) { campo.value = v.substr(0,2) +"."+ v.substr(2,3) +"."+ v.substr(5,3) +"/"+ v.substr(8,4) +"-"+ v.substr(12,2); }
}


