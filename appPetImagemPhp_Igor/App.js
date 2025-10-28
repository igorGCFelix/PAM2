import { View, TouchableOpacity, Text, StyleSheet, Image, Alert, FlatList, ActivityIndicator, SafeAreaView} from 'react-native';
import React, {useEffect, useState} from 'react';
import * as ImagePicker from "expo-image-picker";
import {Ionicons} from "@expo/vector-icons";
import 'react-native-reanimated';

export default function App() {
  const [image, setImage] = useState(null);
  const [images, setImagens] = useState([]);
  const [loading, setLoading] = useState(true);

  async function pickImageFromGallery(){
    let result = await ImagePicker.launchImageLibraryAsync({
      mediaTypes: ImagePicker.MediaTypeOptions.Images,
      allowsEditing:true,
      aspect:[4,3],
      quality:1,
    });

    if (!result.canceled){
      console.log(result);
      setImage(result.assets[0].uri);
    }
  }

  async function takePhoto(){
    let result = await ImagePicker.launchCameraAsync({
      allowsEditing:true,
      aspect: [4,3],
      quality:1,
    });
    
    if(!result.canceled){
      console.log(result);
      setImage(result.assets[0].uri);
    }
  }

  async function uploadImage(){
    if(!image){
      Alert.alert("Nenhuma imagem selecionada","Por favor, selecione ou tire uma foto primeiro.");
      return;
    }

    let filename = image.split('/').pop();
    let match = /\.(\w+)$/.exec(filename);
    let type = match ? `image/${match[1]}`:`image`;

    let formData = new FormData();
    formData.append('photo', {uri: image,name:filename, type});

    try{
      const response = await fetch('http://192.168.3.106/appPetImagemPhp/upload.php',{
        method: 'POST',
        body: formData,
        headers : {
          'Content-Type': 'multipart/form-data',
        },
      });

      if (response.ok){
        Alert.alert("Sucesso", "Imagem enviada com sucesso!");
      }
      else{
        Alert.alert("Erro", "Falha ao enviar imagem.");
      }
      
    }
    catch(error){
        console.error(error);
        Alert.alert("Erro", "Ocorreu um erro ao tentar enviar a imagem.");
    }
  }

  useEffect(() => {
    async function carregarImagens(){
      try{
        const response = await fetch("http://192.168.1.135/appPetImagemPhp/listar_imagens.php");
        const data = await response.json();
        setImagens(data);
      }
      catch(error){
        console.error("Erro ao buscar imagens:", error);
      }
      finally{
        setLoading(false);
      }
    }
    carregarImagens();
  }, []);
  
  if(loading){
    return (
      <View style={styles.loading}>
        <ActivityIndicator size="large" color="#4a90e2"/>
        <Text style={styles.loadingText}>Carregando imagens...</Text>
      </View>
    );
  }

  return (
    <View style={styles.container}>
      {image && (
        <Image source={{uri: image}} style={styles.image}></Image>
      )}

      <TouchableOpacity style={styles.button} onPress={pickImageFromGallery}>
        <Text style={styles.buttonText}>Escolher da Galeria</Text>
      </TouchableOpacity>

      <TouchableOpacity style={styles.button} onPress={takePhoto}>
        <Text style={styles.buttonText}>Tirar Foto</Text>
      </TouchableOpacity>

      <TouchableOpacity style={styles.button} onPress={uploadImage}>
        <Text style={styles.buttonText}>Enviar Imagem</Text>
      </TouchableOpacity>

      <SafeAreaView style={styles.safeArea}>
        <Text style={styles.header}>📷 Galeria de Imagens do BD</Text>
        {ImageBackgroundBase.length === 0 ? (
          <Text style={styles.emptyText}>Nenhuma imagem encontrada.</Text>
        ):(
          <FlatList
            data={imagens}
            keyExtractor={(item, index) => index.toString()}
            renderItem={({item}) => (
              <View style={styles.card}>
                <Image source={{uri:item}} style={styles.imagem}></Image>
              </View>
            )}
            contentConatainerStyle={styles.listContainer}
          ></FlatList>
        )}
      </SafeAreaView>
    </View>

    
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#fff',
    alignItems: 'center',
    justifyContent: 'center',
  },
  button: {
    backgroundColor: "#1e90ff",
    padding:10,
    borderRadius:5,
    marginBottom:20,
  },
  buttonText:{
    color: "#fff",
    fontSize:16,
  },
  image: {
    width: 300,
    heigh:300,
    borderRadius: 10,
    marginTop: 20,
    backgroundColor: "#ccc",
  },

  safeArea: {
    flex:1,
    backgroundColor:"#f5f6fa",
  },
  header:{
    fontSize: 22,
    fontWeight: "bold",
    color: "#333",
    textAlign:"center",
    marginVertical:15,
  },
  listContainer: {
    paddingHorizontal:10,
    paddingBottom: 20,
  },
  card:{
    backgroundColor:"#fff",
    borderRadius:12,
    marginBottom:15,
    overflow:"hidden",
    elevation:3,
    shadowColor: "#000",
    shadowOpacity:0.1,
    shadowRadius:6,
    shadowOffset: {widht:0, height:3},
    widht:"70%",
    alignSelf: "center",
  },
  imagem: {
    width: "100%",
    height: 200,
    resizeMode: "cover",
  },
  loading: {
    flex:1,
    justifyContent: "center",
    alignItems: "center",
  },
  loadingText: {
    marginTop:10,
    fontSize: 16,
    color:"#555",
  },
  emptyText: {
    textAlign:"center",
    marginTop: 20,
    fontSize:16,
    color:"#888",
  },
});
